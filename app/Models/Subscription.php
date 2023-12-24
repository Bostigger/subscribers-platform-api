<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    /**
     * Check if a user is already subscribed to a website.
     *
     * @param int $userId
     * @param int $websiteId
     * @return bool
     */
    public static function isAlreadySubscribed($userId, $websiteId)
    {
        return self::where('user_id', $userId)
            ->where('website_id', $websiteId)
            ->exists();
    }
}
