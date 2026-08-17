<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Equipment;
use App\Models\Part;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class ActivityFeedController extends Controller
{
    /**
     * Feed de atividade recente no formato esperado pelo componente
     * x-ui.analytics.activity-timeline-card.
     */
    public function index(): JsonResponse
    {
        $audits = Audit::query()
            ->with('user')
            ->latest()
            ->take(15)
            ->get();

        $activities = $audits->map(fn (Audit $audit): array => [
            'id' => $audit->id,
            'title' => $this->titleFor($audit),
            'description' => $this->descriptionFor($audit),
            'time_ago' => $audit->created_at?->diffForHumans() ?? 'recentemente',
            'icon_bg' => $this->iconBgFor($audit),
            'dot_color' => $this->dotColorFor($audit),
        ]);

        return response()->json($activities->values());
    }

    private function titleFor(Audit $audit): string
    {
        return match ($audit->auditable_type) {
            Ticket::class => match ($audit->event) {
                'created' => 'Novo ticket registado',
                'updated' => 'Ticket atualizado',
                'deleted' => 'Ticket removido',
                default => 'Ticket alterado',
            },
            Part::class => 'Peça catalogada',
            Equipment::class => 'Equipamento adicionado',
            Room::class => 'Sala registada',
            User::class => 'Utilizador criado',
            default => 'Ação registada',
        };
    }

    private function descriptionFor(Audit $audit): string
    {
        $user = optional($audit->user)->name ?? 'Sistema';
        $subject = $this->subjectName($audit);

        $subjectPart = $subject !== null ? sprintf('«%s»', $subject) : null;

        return match ($audit->auditable_type) {
            Ticket::class => match ($audit->event) {
                'created' => sprintf('Novo ticket %s registado por %s.', $subjectPart ?? '', $user),
                'updated' => sprintf('Ticket %s atualizado por %s.', $subjectPart ?? '', $user),
                'deleted' => sprintf('Ticket %s removido por %s.', $subjectPart ?? '', $user),
                default => sprintf('Ticket %s alterado por %s.', $subjectPart ?? '', $user),
            },
            Part::class => sprintf('Peça %s adicionada ao catálogo por %s.', $subjectPart ?? '', $user),
            Equipment::class => sprintf('Equipamento %s adicionado por %s.', $subjectPart ?? '', $user),
            Room::class => sprintf('Sala %s registada por %s.', $subjectPart ?? '', $user),
            User::class => sprintf('Novo utilizador criado por %s.', $user),
            default => sprintf('Ação registada na auditoria por %s.', $user),
        };
    }

    private function subjectName(Audit $audit): ?string
    {
        $values = $audit->new_values;

        if (is_array($values)) {
            return $values['title'] ?? $values['name'] ?? null;
        }

        return null;
    }

    private function iconBgFor(Audit $audit): string
    {
        return match ($audit->auditable_type) {
            Ticket::class => 'bg-blue-500/10',
            Part::class, Equipment::class => 'bg-emerald-500/10',
            Room::class => 'bg-amber-500/10',
            User::class => 'bg-purple-500/10',
            default => 'bg-slate-500/10',
        };
    }

    private function dotColorFor(Audit $audit): string
    {
        return match ($audit->auditable_type) {
            Ticket::class => 'bg-blue-500',
            Part::class, Equipment::class => 'bg-emerald-500',
            Room::class => 'bg-amber-500',
            User::class => 'bg-purple-500',
            default => 'bg-slate-500',
        };
    }
}
