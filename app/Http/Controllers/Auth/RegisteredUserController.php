<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\StoreUserRequest;
use App\Http\Requests\api\v1\UpdateUserRequest;
use App\Http\Resources\api\v1\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index()
    {
        $users = User::with('endorsements', 'applications', 'openings', 'logBooks')->get();
        return new Collection($users);
    }

    public function show(User $user)
    {
        $transformedUser = User::with('endorsements', 'applications', 'openings')->find($user->id);
        return new UserResource($transformedUser);
    }

    public function store(StoreUserRequest $request): Response
    {
        $request->validated($request->all());
        $request['password'] = bcrypt($request['password']);

        $user = User::create($request->all());

        event(new Registered($user));

        Auth::login($user);

        return response(['data' => $user, 'message' => 'User Created successfully']);
    }

    public function update(Request $request, User $user): Response
    {
        $request->validate(
            $request['is_Method'] === 'PUT' ?
                [
                    "email" => ['required', 'email'],
                    "matric_no" => ['required', 'min:5'],
                    "name" => ['required', 'max:50', 'min:5'],
                    "user_role" => ['required', Rule::in(['student', 'lecturer', 'supervisor'])],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()]
                ] : [
                    "email" => ['sometimes', 'email'],
                    "matric_no" => ['sometimes', 'min:5'],
                    "name" => ['sometimes', 'max:50', 'min:5'],
                    "user_role" => ['sometimes', Rule::in(['student', 'lecturer', 'supervisor'])],
                    'password' => ['sometimes', 'confirmed', Rules\Password::defaults()]
                ]
            );
        $userData = $request->except('password');

        if ($request->has('password')) {
            $userData['password'] = bcrypt($request->input('password'));
        }

        $user->update($userData);

        return response(['message' => 'User '.$user->name.' updated successfully', "status" => "success", "code" => 201]);
    }

}
