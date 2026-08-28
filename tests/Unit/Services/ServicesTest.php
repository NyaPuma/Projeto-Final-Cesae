<?php

namespace Tests\Unit\Services;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Notification;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\AnalyticsDashboardService;
use App\Services\BudgetCalculatorService;
use App\Services\CalendarService;
use App\Services\EquipmentService;
use App\Services\PasswordResetService;
use App\Services\TechnicianAssignmentService;
use App\Services\UserService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;
use Tests\Concerns\CreatesUsers;

class ServicesTest extends FeatureTestCase
{
    use CreatesTickets;
    use CreatesUsers;

    private UserService $userService;
    private EquipmentService $equipmentService;
    private BudgetCalculatorService $budgetCalculator;
    private PasswordResetService $passwordReset;
    private TechnicianAssignmentService $assignment;
    private CalendarService $calendar;
    private AnalyticsDashboardService $dashboard;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();

        $this->userService = app(UserService::class);
        $this->equipmentService = app(EquipmentService::class);
        $this->budgetCalculator = app(BudgetCalculatorService::class);
        $this->passwordReset = app(PasswordResetService::class);
        $this->assignment = app(TechnicianAssignmentService::class);
        $this->calendar = app(CalendarService::class);
        $this->dashboard = app(AnalyticsDashboardService::class);
    }

    // --- UserService ---

    public function test_hash_token_is_deterministic_hmac(): void
    {
        $a = $this->userService->hashToken('token-a');
        $b = $this->userService->hashToken('token-a');
        $c = $this->userService->hashToken('token-b');

        $this->assertSame($a, $b);
        $this->assertNotSame($a, $c);
        $this->assertSame(64, strlen($a));
    }

    public function test_ensure_default_profile_assigns_user_role_when_missing(): void
    {
        $user = User::factory()->create(['profile_id' => null]);

        $this->userService->ensureDefaultProfile($user);

        $this->assertSame(
            UserProfile::where('name', UserRoleEnum::User->value)->first()->id,
            $user->fresh()->profile_id
        );
    }

    public function test_available_roles_are_all_user_profiles(): void
    {
        $roles = $this->userService->getAvailableRoles();
        $this->assertContains(UserRoleEnum::Admin->value, $roles);
        $this->assertContains(UserRoleEnum::Technician->value, $roles);
        $this->assertContains(UserRoleEnum::User->value, $roles);
    }

    // --- EquipmentService ---

    public function test_equipment_list_filters_by_search_and_status(): void
    {
        $category = EquipmentCategory::factory()->create();
        Equipment::factory()->create(['category_id' => $category->id, 'name' => 'Portátil A', 'serial' => 'SN-XYZ', 'active' => true]);
        Equipment::factory()->create(['category_id' => $category->id, 'name' => 'Impressora B', 'serial' => 'SN-ABC', 'active' => false]);

        $this->assertSame(2, $this->equipmentService->listPaginated()->total());
        $this->assertSame(1, $this->equipmentService->listPaginated('SN-XYZ')->total());
        $this->assertSame(1, $this->equipmentService->listPaginated(null, 'inactive')->total());
        $this->assertSame(1, $this->equipmentService->listPaginated(null, 'active')->total());
        $this->assertSame(1, $this->equipmentService->listPaginated('SN-ABC')->total());
    }

    // --- BudgetCalculatorService ---

    public function test_budget_calculator_totals_and_breakdown(): void
    {
        $ticket = Ticket::factory()->create(['budget_details' => [
            ['type' => 'material', 'quantity' => 2, 'unit_price' => 10],
            ['type' => 'material', 'quantity' => 1, 'unit_price' => 5],
            ['type' => 'labor', 'hours' => 3, 'hourly_rate' => 20],
        ]]);

        $this->assertSame(25.0, $this->budgetCalculator->calculateTotalMaterialCost($ticket));
        $this->assertSame(60.0, $this->budgetCalculator->calculateTotalLaborCost($ticket));
        $this->assertSame(85.0, $this->budgetCalculator->calculateBudgetTotal($ticket));

        $breakdown = $this->budgetCalculator->getBreakdown($ticket);
        $this->assertCount(2, $breakdown['materials']);
        $this->assertCount(1, $breakdown['labor']);
        $this->assertSame(25.0, $breakdown['material_total']);
        $this->assertSame(60.0, $breakdown['labor_total']);
        $this->assertSame(85.0, $breakdown['grand_total']);
    }

    public function test_budget_calculator_defaults_items_without_type_to_material(): void
    {
        $ticket = Ticket::factory()->create(['budget_details' => [
            ['quantity' => 4, 'unit_price' => 3],
        ]]);

        $this->assertSame(12.0, $this->budgetCalculator->calculateTotalMaterialCost($ticket));
        $this->assertSame(0.0, $this->budgetCalculator->calculateTotalLaborCost($ticket));
    }

    // --- PasswordResetService ---

    public function test_password_reset_token_roundtrip_and_clear(): void
    {
        $user = $this->createUserWithPassword(UserRoleEnum::User->value, 'reset@example.com', 'password');

        $token = $this->passwordReset->createResetToken(' RESET@EXAMPLE.COM ');
        $this->assertSame($user->id, $this->passwordReset->validateToken('reset@example.com', $token)?->id);
        $this->assertNull($this->passwordReset->validateToken('reset@example.com', 'token-errado'));

        $this->passwordReset->resetPassword($user, 'nova-password');

        $this->assertTrue(DB::table('password_reset_tokens')->where('email', 'reset@example.com')->doesntExist());
        $this->assertNull($user->fresh()->api_token);
    }

    public function test_password_reset_token_expires_after_60_minutes(): void
    {
        $user = $this->createUserWithPassword(UserRoleEnum::User->value, 'expire@example.com', 'password');

        $token = $this->passwordReset->createResetToken('expire@example.com');

        $this->travel(61)->minutes();

        $this->assertNull($this->passwordReset->validateToken('expire@example.com', $token));
    }

    // --- TechnicianAssignmentService ---

    public function test_least_busy_technician_is_picked_and_manual_assignment_validated(): void
    {
        $techA = $this->createTechnician();
        $techB = $this->createTechnician();
        $user = $this->createRegularUser();

        $inProgressId = app(\App\Services\TicketStatusService::class)->getByName(TicketStatusEnum::InProgress);
        $this->createTicket(['assigned_to' => $techA->id, 'status_id' => $inProgressId]);

        $this->assertSame($techB->id, $this->assignment->getLeastBusyTechnician()?->id);

        $ticket = $this->createTicket();

        $this->assertNull($this->assignment->assignToTicket($ticket, $user->id));
        $this->assertNull($ticket->fresh()->assigned_to);

        $this->assertSame($techA->id, $this->assignment->assignToTicket($ticket, $techA->id)?->id);
        $this->assertSame($techA->id, $ticket->fresh()->assigned_to);
    }

    public function test_find_most_urgent_open_ticket_orders_critical_first_then_oldest(): void
    {
        $openId = app(\App\Services\TicketStatusService::class)->getByName(TicketStatusEnum::Open);
        $old = $this->createTicket(['priority' => TicketPriorityEnum::Medium->value, 'status_id' => $openId]);
        $old->update(['created_at' => now()->subDays(2)]);
        $critical = $this->createTicket(['priority' => TicketPriorityEnum::Critical->value, 'status_id' => $openId]);
        $critical->update(['created_at' => now()->subHours(1)]);
        $this->createTicket(['priority' => TicketPriorityEnum::High->value, 'status_id' => $openId]);

        $this->assertSame($critical->id, $this->assignment->findMostUrgentOpenTicket()?->id);
    }

    // --- CalendarService ---

    public function test_calendar_restricts_scheduled_events_for_technicians(): void
    {
        $tech = $this->createTechnician();
        $otherTech = $this->createTechnician();

        $this->createTicket(['assigned_to' => $tech->id, 'scheduled_at' => now()->addDay()]);
        $this->createTicket(['assigned_to' => $otherTech->id, 'scheduled_at' => now()->addDay()]);
        $this->createTicket(['assigned_to' => $tech->id, 'scheduled_at' => null]);

        $admin = $this->createAdmin();
        $this->assertCount(2, $this->calendar->getScheduledEventsForUser($admin));
        $this->assertCount(1, $this->calendar->getScheduledEventsForUser($tech));
    }

    // --- AnalyticsDashboardService (priority bucket bug regression) ---

    public function test_dashboard_priority_buckets_include_critical_tickets(): void
    {
        $this->createTicket(['priority' => TicketPriorityEnum::Low->value]);
        $this->createTicket(['priority' => TicketPriorityEnum::Critical->value]);

        $payload = $this->dashboard->getDashboardPayload();

        $this->assertSame(['Baixa', 'Média', 'Alta'], $payload['by_priority']['labels']->all());
        $this->assertSame([1, 0, 1], $payload['by_priority']['data']->all());
    }

    public function test_dashboard_payload_shape(): void
    {
        $this->createTicket();

        $payload = $this->dashboard->getDashboardPayload();

        $this->assertArrayHasKey('open_tickets', $payload);
        $this->assertArrayHasKey('in_progress_tickets', $payload);
        $this->assertArrayHasKey('closed_tickets', $payload);
        $this->assertArrayHasKey('sla_success', $payload);
        $this->assertArrayHasKey('top_equipments', $payload);
        $this->assertArrayHasKey('monthly_tickets', $payload);
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $payload['top_rooms']);
        $this->assertIsArray($payload['monthly_tickets']['labels']);
    }
}
