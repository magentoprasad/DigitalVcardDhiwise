<?php

namespace App\Http\Controllers\API\Device;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Device\CreateUserAPIRequest;
use App\Http\Requests\Device\UpdateUserAPIRequest;
use App\Http\Resources\Device\UserCollection;
use App\Http\Resources\Device\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends AppBaseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * User's Listing API.
     * Limit Param: limit
     * Skip Param: skip.
     *
     * @param Request $request
     *
     * @return UserCollection
     */
    public function index(Request $request): UserCollection
    {
        $users = $this->userRepository->all(
            $request->all(),
            $request->get('skip', null),
            $request->get('limit', null),
        );

        return new UserCollection($users);
    }

    /**
     * Create User with given payload.
     *
     * @param CreateUserAPIRequest $request
     *
     * @return UserResource
     */
    public function store(CreateUserAPIRequest $request): UserResource
    {
        $input = $request->all();
        if (isset($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }
        $user = $this->userRepository->create($input);

        return new UserResource($user);
    }

    /**
     * Get single User record.
     *
     * @param int $id
     *
     * @return UserResource
     */
    public function show(int $id): UserResource
    {
        $user = $this->userRepository->findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Update User with given payload.
     *
     * @param UpdateUserAPIRequest $request
     * @param int                  $id
     *
     * @return UserResource
     */
    public function update(UpdateUserAPIRequest $request, int $id): UserResource
    {
        $input = $request->all();
        if (isset($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }
        $user = $this->userRepository->update($input, $id);

        return new UserResource($user);
    }
}
