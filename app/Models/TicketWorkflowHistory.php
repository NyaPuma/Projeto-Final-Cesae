<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketWorkflowHistory extends Model
{
    use HasFactory;

    // Define explicitamente o nome da tabela devido ao formato unificado
    protected $table = 'ticket_workflow_history';

    protected $fillable = [
        'ticket_id',
        'origin_status_id',
        'destination_status_id',
        'technician_id',
        'comment'
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function originStatus(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'origin_status_id');
    }

    public function destinationStatus(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'destination_status_id');
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}
