<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UserStoreRequest;
use App\Http\Requests\Api\V1\UserUpdateRequest;
use App\Http\Resources\Api\V1\UserCollection;
use App\Http\Resources\Api\V1\UserResource;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): UserCollection
    {
        $users = $this->userRepository->all();

        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $user = $this->userRepository->create($request->all());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): UserResource
    {
        $user = $this->userRepository->find($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, int $id)
    {
        $user = $this->userRepository->update($id, $request->all());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->userRepository->delete($id);

        return response()->json(['message' => 'User deleted successfully!'], 200);
    }
}
