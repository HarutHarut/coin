<?php


namespace App\Services;


use App\Models\User;
use App\Repositories\FileRepository;
use App\Repositories\ResponseRepository;
use App\Repositories\UserRepository;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class UserService
{
    protected $userRepo;
    protected $response;
    protected $fileRepo;

    /**
     * AuthController constructor.
     * @param UserRepository $userRepo
     * @param ResponseRepository $response
     * @param FileRepository $fileRepo
     */
    public function __construct(UserRepository $userRepo,
                                ResponseRepository $response,
                                FileRepository $fileRepo)
    {
        $this->userRepo = $userRepo;
        $this->response = $response;
        $this->fileRepo = $fileRepo;
    }

    /**
     * @param $data
     * @return string
     */
    public function createUser($data)
    {
        $data['password'] = Hash::make($data['password']);
        try {
            DB::beginTransaction();
            $user = $this->userRepo->create($data);
            $response['user'] = $user;
            if (isset($data['avatar'])) {
                $data['avatar'] = Storage::putFile('public/user', $data['avatar']);
                $response['avatar'] = $this->fileRepo->createFile($data['avatar'], User::class, $user->id);
            }
            DB::commit();

            $response['token'] = $user->createToken('authToken')->accessToken;

            return $this->response->success($response);

        } catch (Exception $e) {
            return $this->response->notFound();
        } catch (\Throwable $e) {
            return $this->response->notFound();
        }
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function login($data)
    {
        try {
            $user = User::where('email', $data['email'])
                ->first();

            if ($user && Hash::check($data['password'], $user->password)) {
                $response['user'] = $user;
                $response['token'] = $user->createToken('authToken')->accessToken;

                return $this->response->success($response);
            }
            return $this->response->notFound();

        } catch (Exception $e) {
            return $this->response->badRequest();
        } catch (\Throwable $e) {
            return $this->response->badRequest();
        }
    }

    /**
     * @param $data
     * @param $id
     * @return JsonResponse
     */
    public function updateUser($data, $id)
    {
        try {
            $user = $this->userRepo->update($data, $id);

            $response['avatar'] = $user;
            if (isset($data['avatar'])) {
                $data['avatar'] = Storage::put('public/user', $data['avatar']);

                if (isset($user->file->path)) {
                    Storage::delete($user->file->path);
                    $response['avatar'] = $this->fileRepo->updateFile($data['avatar'], $user);
                } else {
                    $response['avatar'] = $this->fileRepo->createFile($data['avatar'], User::class, $user->id);
                }
            }

            return $this->response->success($response, 'User updated');

        } catch (\Throwable $e) {
            return $this->response->badRequest();
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteUser($id)
    {
        try {
            $message = $this->userRepo->delete($id);

            return $this->response->success([], $message);

        } catch (\Throwable $e) {
            return $this->response->badRequest();
        }
    }
}
