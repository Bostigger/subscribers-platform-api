<?php

namespace App\Services;

use App\Contracts\SubscriptionServiceInterface;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;


class SubscriptionService implements SubscriptionServiceInterface
{
    public function subscribeUserToWebsite($userId, $websiteId)
    {
        $user = User::find($userId);
        if (!$user) {
            return ['error' => 'User not found', 'status' => 404];
        }

        $website = Website::find($websiteId);
        if (!$website) {
            return ['error' => 'Website not found', 'status' => 404];
        }

        if (Subscription::isAlreadySubscribed($userId, $websiteId)) {
            return ['error' => 'User already subscribed to this website', 'status' => 409];
        }

        $newSubscription = new Subscription();
        $newSubscription->user_id = $userId;
        $newSubscription->website_id = $websiteId;
        $newSubscription->save();

        return $newSubscription;
    }
}
