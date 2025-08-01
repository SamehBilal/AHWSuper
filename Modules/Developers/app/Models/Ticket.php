<?php

namespace Modules\Developers\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'developers.tickets';

    protected $fillable = [
        'user_id',
        'ticket_number',
        'title',
        'category',
        'priority',
        'status',
        'description',
        'steps_to_reproduce',
        'expected_behavior',
        'actual_behavior',
        'environment_details',
        'api_endpoint',
        'error_message',
        'contact_email',
        'attachments',
        'resolved_at',
        'admin_notes',
        'assigned_to'
    ];

    protected $casts = [
        'attachments' => 'array',
        'resolved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeResolved($query)
    {
        return $query->where('status', 'resolved');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByAssignedUser($query, $assignedTo)
    {
        return $query->where('assigned_to', $assignedTo);
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('title', 'like', '%' . $searchTerm . '%')
              ->orWhere('description', 'like', '%' . $searchTerm . '%')
              ->orWhere('ticket_number', 'like', '%' . $searchTerm . '%');
        });
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeWithAttachments($query)
    {
        return $query->whereNotNull('attachments');
    }

    public function scopeWithoutAttachments($query)
    {
        return $query->whereNull('attachments');
    }

    public function scopeResolvedWithin($query, $days)
    {
        return $query->whereNotNull('resolved_at')
                     ->where('resolved_at', '>=', now()->subDays($days));
    }

    public function scopeUnresolved($query)
    {
        return $query->whereNull('resolved_at');
    }

}
