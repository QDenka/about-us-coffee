<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email', 
        'message',
        'ip_address',
        'user_agent',
        'status',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeRecent($query)
    {
        return $query->where('created_at', '>=', now()->subHour());
    }

    public function markAsRead()
    {
        $this->update([
            'status' => 'read',
            'read_at' => now(),
        ]);
    }

    public function markAsSpam()
    {
        $this->update(['status' => 'spam']);
    }

    public static function isRateLimited($ip, $email)
    {
        $ipCount = static::where('ip_address', $ip)
            ->where('created_at', '>=', now()->subHour())
            ->count();
            
        $emailCount = static::where('email', $email)
            ->where('created_at', '>=', now()->subHour())
            ->count();

        return $ipCount >= 3 || $emailCount >= 2;
    }
}
