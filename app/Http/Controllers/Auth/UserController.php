<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
class UserController extends Controller
{
    public function connected_user()
    {
        $user = auth()->user();

        $roles = $user->roles;

        return array_merge($user->toArray(), [
            'roles' => $roles[0]
        ]);
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password'
        ]);

        $user = new User();
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->username = $fields['username'];
        $user->password = bcrypt($fields['password']);
        if ($request->image) {
            $filename = $request->image->getClientOriginalName();
            $destinationPath = public_path('user_profile');
            $request->image->move($destinationPath, $filename);
            $user->image = 'user_profile/' . $filename;
        }
        $user->save();
        $user_role = UserRole::create([
            'user_id' => $user->id,
            'role_id' => 3,
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return $response;
    }
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        // check email if exist in database

        $champs = 'email';
        if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
            $champs = 'username';
        }

        $user = User::where($champs, $fields['email'])->first();

        // check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Wrong password'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'roles' => $user->roles,
        ];
        return response($response, 201);
    }
    public function logout(User $user)
    {
        $user->tokens()->delete();

        return [
            'message' => 'Logged Out'
        ];
    }
    public function index()
    {
        $Role = Role::all();
        $users = User::with('roles')->get();
        $response = [
            'users' => $users,
            'roles' => $Role,
            //'roleuser'=> $users->roles,
        ];
        return $response; //response($response,201);
    }

    public function changePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ], [
            'old_password.required' => 'Enter the old password',
            'new_password.required' => 'Enter the password',
            'new_password.min' => 'Enter minimum 5 characters',
            'new_password.max' => 'Enter maximum 25 characters',
            'confirm_password.same' => 'Must be the same with the new password',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        $user = User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return $user;
    }
    public function addRoles(Request $request)
    {
        $fields = $request->validate([
            'user_id' => 'required',
            'exists:users,id',
            'role_id' => [
                'integer',
                'exists:roles,id',
                'required',
                Rule::unique('user_roles')
                    ->where('user_id', $request->user_id)
            ]
        ]);

        $user_role = UserRole::create([
            'user_id' => $fields['user_id'],
            'role_id' => $fields['role_id'],
        ]);

        return $user_role;
    }
    // public function editRoles(Request $request,$user_id)
    // {
    //     $user = User::findOrFail($user_id);

    //     $roles = Role::pluck('name','name')->all();
    //     $userRole = $user->roles->pluck('name','name')->all();

    // }
}
