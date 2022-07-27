<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\ResponseRepository;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $response;
    protected $userService;

    /**
     * AuthController constructor.
     * @param ResponseRepository $response
     * @param UserService $userService
     */
    public function __construct(ResponseRepository $response,
                                UserService $userService)
    {
        $this->response = $response;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $users = User::with('file')->get();
        $response['users'] = $users;
        return $this->response->success($response);
    }

    /**
     * @param RegistrationRequest $request
     * @return string
     */
    public function store(RegistrationRequest $request)
    {
        $data = $request->validated();
        return $this->userService->createUser($data);
    }

    /**
     * @param UpdateUserRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();
        return $this->userService->updateUser($data, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        return $this->userService->deleteUser($id);
    }
}
