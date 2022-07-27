<?php

namespace App\Http\Middleware;

use App\Repositories\UserRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    protected $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Handle an incoming request.`
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->role->name !== 'admin') {
            return response()->json([
                'data' => [],
                'message' => 'You dont have permission for this request'
            ], 403);
        }
        return $next($request);

    }
}
