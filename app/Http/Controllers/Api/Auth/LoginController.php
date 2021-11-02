<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersCollection;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class LoginController extends Controller
{
    protected $redirectTo = '/';

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $auth = $request->except(['remember_me']);
        $user = User::where('username', $request->username)->where('status', 1)->first();
        if (Hash::check($request->password, $user->getAuthPassword())) {
            $token = $user->createToken(time());
            return response()->json(['status' => 'success', 'data' => $token->plainTextToken], 200);
        }
        return response()->json(['status' => 'failed']);
    }

    public function getUserLogin()
    {
        $user = request()->user();
        $permissions = [];
        foreach (Permission::all() as $permission) {
            if (request()->user()->can($permission->name)) {
                $permissions[] = $permission->name;
            }
        }
        $user['permission'] = $permissions;
        if ($user->position_id != null) {
            $positions = Position::where('id', $user->position_id)->first();
            $positions = $positions->name;
            $user['position'] = $positions;
        }
        return response()->json(['status' => 'success', 'data' => $user]);
    }

    public function userLists()
    {
        $user = User::orderBy('name', 'ASC');
        return new UsersCollection($user->get());
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
    }

}
