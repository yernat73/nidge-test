<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserIndexRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\PaginatorResource;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(UserIndexRequest $request): JsonResponse
    {
        $users = $this->userService->index($request->safe()->collect()->reject(fn ($param) => empty($param)));

        return response()->json([
            'users' => UserResource::collection($users),
            'pagination' => PaginatorResource::make($users),
        ]);
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        $this->userService->store($request->validated());

        return response()->json();
    }

    public function update(UserUpdateRequest $request): JsonResponse
    {
        $this->userService->update($request->safe()->collect()->reject(fn ($param) => empty($param)));

        return response()->json();
    }

    public function destroy(UserDestroyRequest $request): JsonResponse
    {
        $this->userService->destroy($request->integer('id'));

        return response()->json();
    }
}