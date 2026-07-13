<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class UiController extends Controller
{
    /**
     * Mostra o painel principal da interface web.
     */
    public function index(Request $request)
    {
        $user = $this->authenticatedUser($request);
        return view('ui.index', ['user' => $user]);
    }

    /**
     * Mostra a página com a lista de tickets.
     */
    public function tickets(Request $request)
    {
        $user = $this->authenticatedUser($request);
        return view('ui.tickets', ['user' => $user]);
    }

    /**
     * Mostra a página de criação de um novo ticket.
     */
    public function ticketCreate(Request $request)
    {
        $user = $this->authenticatedUser($request);
        return view('ui.ticket-create', ['user' => $user]);
    }

    /**
     * Mostra a página com os equipamentos registados.
     */
    public function equipments(Request $request)
    {
        $user = $this->authenticatedUser($request);
        return view('ui.equipments', ['user' => $user]);
    }

    /**
     * Mostra a página com os utilizadores do sistema.
     */
    public function users(Request $request)
    {
        $user = $this->authenticatedUser($request);
        return view('ui.users', ['user' => $user]);
    }

    /**
     * Mostra a página de criação de um novo ticket.
     */
    public function rooms(Request $request)
    {
        $user = $this->authenticatedUser($request);
        return view('ui.rooms.index', ['user' => $user]);
    }


    /**
     * Mostra a página de criação de uma nova sala.
     */
    public function roomCreate(Request $request)
    {
        $user = $this->authenticatedUser($request);
        return view('ui.rooms.create', ['user' => $user]);
    }

    /**
     * Mostra os detalhes de uma sala específica.
     */
    public function roomDetail(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        // Busca a sala pelo ID para enviar para a view
        $room = \App\Models\Room::findOrFail($id);
        return view('ui.rooms.show', ['room' => $room, 'user' => $user]);
    }

    /**
     * Mostra o formulário de edição de uma sala.
     */
    public function roomEdit(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        // Busca a sala pelo ID para pré-preencher o formulário
        $room = \App\Models\Room::findOrFail($id);
        return view('ui.rooms.edit', ['room' => $room, 'user' => $user]);
    }


    /**
     * Mostra a página de auditoria.
     */
    public function audits(Request $request)
    {
        $user = $this->authenticatedUser($request);
        return view('ui.audits', ['user' => $user]);
    }


    /**
     * Mostra os detalhes de um ticket específico.
     * * @param int $id ID do ticket a visualizar.
     */
    public function ticketDetail(Request $request, int $id)
    {
        $user = $this->authenticatedUser($request);
        return view('ui.ticket-detail', ['ticketId' => $id, 'user' => $user]);
    }

    /**
     * Retorna a lista de equipamentos para a interface (acessível a todos os utilizadores).
     */
    public function getEquipments(Request $request)
    {
        $user = $this->authenticatedUser($request);
        // Retorna todos os equipamentos com as respetivas salas
        return response()->json(['equipments' => Equipment::with('room')->orderBy('name')->paginate(15)]);
    }

    /**
     * Mostra a página de analytics com gráficos e relatórios.
     */
    public function analytics(Request $request)
    {
        $user = $this->authenticatedUser($request);
        return view('ui.analytics', ['user' => $user]);
    }

    /**
     * Mostra a página de perfil do utilizador autenticado.
     */
    public function profile(Request $request)
    {
        $user = $this->authenticatedUser($request);
        return view('ui.profile', ['user' => $user]);
    }
}
