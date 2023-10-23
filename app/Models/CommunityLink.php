<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLink extends Model
{

    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class, 'community_link_users');
    }
    protected $fillable = [
        'user_id', 'channel_id', 'title', 'link', 'approved'
    ];


    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    protected static function hasAlreadyBeenSubmitted($link)
    {
        if ($existing = static::where('link', $link)->first()) {
            if (Auth::user()->isTrusted()) {
                $existing->touch();
                $existing->save();
            }
            return true;
        }
        return false;
    }

}
