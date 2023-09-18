<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomNotificationStoreRequest;
use App\Services\CustomNotificationService;
use Illuminate\Http\JsonResponse;

class CustomNotificationController extends Controller
{
    private CustomNotificationService $customNotificationService;

    public function __construct(CustomNotificationService $customNotificationService)
    {
        $this->customNotificationService = $customNotificationService;
    }

    public function store(CustomNotificationStoreRequest $request): JsonResponse
    {
        $this->customNotificationService->notifyAllUsers($request->string('message')->value());

        return response()->json();
    }
}