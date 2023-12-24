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
        $response = $this->subscriptionService->subscribeUserToWebsite($request->validated, $websiteId);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], $response['status']);
        }

        return response()->json(['message' => 'Subscribed successfully'], 200);
    }


}
