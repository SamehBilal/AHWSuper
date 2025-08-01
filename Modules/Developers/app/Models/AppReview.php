<?php

namespace Modules\Developers\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppReview extends Model
{
    use HasFactory;

    protected $table = 'developers.app_reviews';

    protected $fillable = [
        'app_id',
        'user_id',
        'rating',
        'comment',
        'is_verified'
    ];

    protected $casts = [
        'is_verified' => 'boolean'
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
