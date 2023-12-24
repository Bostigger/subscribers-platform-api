<?php

namespace App\Contracts;

interface SubscriptionServiceInterface
{
    /**
     * Subscribe a user to a website.
     *
     * This method handles the logic of subscribing a given user to a given website.
     * It should ensure that the user and website exist and that the user is not
     * already subscribed to the website.
     *
     * @param int $userId The ID of the user to subscribe.
     * @param int $websiteId The ID of the website to which the user will be subscribed.
     * @return mixed The result of the subscription operation, typically a Subscription model instance or null.
     */
    public function subscribeUserToWebsite($userId, $websiteId);
}
