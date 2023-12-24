<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Services\SubscriptionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubscriptionController extends Controller
{
    protected $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Subscribe a user to a website.
     *
     * @param SubscribeRequest $request
     * @param int $websiteId
     * @return JsonResponse
     */
    public function subscribe(SubscribeRequest $request, $websiteId): JsonResponse
    {
        try {
            $response = $this->subscriptionService->subscribeUserToWebsite(
                $request->validated()['user_id'],
                $websiteId
            );

            return response()->json(['message' => 'Subscribed successfully'], ResponseAlias::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], ResponseAlias::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
