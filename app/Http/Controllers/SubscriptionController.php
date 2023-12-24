<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Services\SubscriptionService;


class SubscriptionController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function subscribe(SubscribeRequest $request, $websiteId)
    {
        // Validate the request and get the validated data
        $validatedData = $request->validated();

        // Access the user_id from the validated data
        $userId = $validatedData['user_id'];

        $response = $this->subscriptionService->subscribeUserToWebsite($userId, $websiteId);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], $response['status']);
        }

        return response()->json(['message' => 'Subscribed successfully'], 200);
    }


}
