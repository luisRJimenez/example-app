<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }


    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user() ? : '',
                'user_roles' => $request->user() ? $request->user()->roles->pluck('name') : [],
                'user_permissions' => $request->user() ? $request->user()->getPermissionsViaRoles()->pluck('name') : [],
            ],
            'flag' => [
                'message' => fn() => $request->session()->get('message')
            ],
            'csrf_token' => $request->session()->token(),
            'resent' => $request->session()->get('resent'),
            'status' => $request->session()->get('status'),
            'success' => $request->session()->get('success'),
        ]);
    }
}
