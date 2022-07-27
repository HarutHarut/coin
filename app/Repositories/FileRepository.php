<?php


namespace App\Repositories;


use App\Models\File;
use App\Models\User;

class FileRepository
{
    protected $user;
    protected $file;

    /**
     * AuthController constructor.
     * @param User $user
     * @param File $file
     */
    public function __construct(User $user, File $file)
    {
        $this->user = $user;
        $this->file = $file;
    }

    /**
     * @param $path
     * @param $type
     * @param $id
     * @return mixed
     */
    public function createFile($path, $type, $id)
    {
        return File::create([
            'fileable_type' => $type,
            'fileable_id' => $id,
            'path' => $path
        ]);
    }

    /**
     * @param $path
     * @param $user
     * @return mixed
     */
    public function updateFile($path, $user)
    {
        $user->file->path = $path;
        $user->file->save();
        return $user;
    }
}
