<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Services\EquipmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UiController extends Controller
{
    public function __construct(
        private readonly EquipmentService $equipmentService,
    ) {}

    public function index(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.index', ['user' => $user]);
    }

    public function tickets(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.tickets', ['user' => $user]);
    }

    public function ticketCreate(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.ticket-create', ['user' => $user]);
    }

    public function equipments(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.equipments', ['user' => $user]);
    }

    public function users(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.users', ['user' => $user]);
    }

    public function userCreate(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.users-create', ['user' => $user]);
    }

    public function userEdit(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $targetUser = User::with('profile')->findOrFail($id);

        return view('ui.users-edit', ['user' => $user, 'targetUser' => $targetUser]);
    }

    public function rooms(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.rooms', ['user' => $user]);
    }

    public function roomCreate(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.rooms.create', ['user' => $user]);
    }

    public function roomDetail(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $room = Room::findOrFail($id);

        return view('ui.rooms.show', ['room' => $room, 'user' => $user]);
    }

    public function roomEdit(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        $room = Room::findOrFail($id);

        return view('ui.rooms.edit', ['room' => $room, 'user' => $user]);
    }

    public function audits(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.audits', ['user' => $user]);
    }

    public function ticketDetail(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.ticket-detail', ['ticketId' => $id, 'user' => $user]);
    }

    public function getEquipments(Request $request): JsonResponse
    {
        $this->authenticatedUser($request);

        $equipments = $this->equipmentService->listPaginated(
            $request->query('q'),
            $request->query('status'),
        );

        return response()->json(['equipments' => $equipments]);
    }

    public function analytics(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.analytics', ['user' => $user]);
    }

    public function profile(Request $request)
    {
        $user = $this->authenticatedUser($request);

        return view('ui.profile', ['user' => $user]);
    }
}
