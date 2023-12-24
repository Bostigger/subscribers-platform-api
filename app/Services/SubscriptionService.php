<?php

namespace App\Services;

use App\Contracts\SubscriptionServiceInterface;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SubscriptionService implements SubscriptionServiceInterface
{
    protected $subscriptionModel;

    public function __construct(Subscription $subscriptionModel)
    {
        $this->subscriptionModel = $subscriptionModel;
    }

    /**
     * Subscribe a user to a website.
     *
     * @param int $userId The ID of the user.
     * @param int $websiteId The ID of the website.
     * @return Subscription The created subscription.
     *
     * @throws ModelNotFoundException If the user or website is not found.
     * @throws \Exception If the user is already subscribed.
     */
    public function subscribeUserToWebsite($userId, $websiteId): Subscription
    {
        $user = User::find($userId);
        if (!$user) {
            throw new ModelNotFoundException("User not found.");
        }

        $website = Website::find($websiteId);
        if (!$website) {
            throw new ModelNotFoundException("Website not found.");
        }

        if ($this->subscriptionModel->isAlreadySubscribed($userId, $websiteId)) {
            throw new \Exception("User already subscribed to this website.");
        }

        $newSubscription = $this->subscriptionModel->create([
            'user_id' => $userId,
            'website_id' => $websiteId,
        ]);

        return $newSubscription;
    }
}
