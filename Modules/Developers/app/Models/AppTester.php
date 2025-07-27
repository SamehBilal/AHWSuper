<?php

namespace Modules\Developers\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppTester extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
   protected $fillable = [
        'oauth_client_id',
        'user_id',
        'invited_by',
        'email',
        'message',
        'status',
        'invitation_token',
        'accepted_at',
        'rejected_at',
    ];
    protected $table = 'app_testers';

    protected $casts = [
        'accepted_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function oauthClients()
    {
        return $this->belongsTo(Client::class, 'oauth_client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function invitedBy()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    public function accept()
    {
        $this->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);
    }

    public function reject()
    {
        $this->update([
            'status' => 'rejected',
            'rejected_at' => now(),
        ]);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
