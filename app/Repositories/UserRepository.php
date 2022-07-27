<?php


namespace App\Repositories;


use App\Models\Image;
use App\Models\User;

class UserRepository
{
    protected $response;
    protected $user;

    /**
     * AuthController constructor.
     * @param ResponseRepository $response
     * @param User $user
     */
    public function __construct(ResponseRepository $response, User $user)
    {
        $this->response = $response;
        $this->user = $user;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->user->create($data);
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        $user = $this->user->find($id);
        $user->update($data);
        return $user;
    }

    /**
     * @param $id
     * @return string
     */
    public function delete($id)
    {
        $user = $this->user->find($id);
        $user->file()->delete();
        $user->delete();
        return 'User deleted';
    }

}
