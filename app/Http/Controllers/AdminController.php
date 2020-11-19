<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserForm;
use App\Models\User;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        return Auth::guard('admin_guard')->attempt($credentials) ?
            redirect('/admin/home')
            :
            redirect('/admin')->with('err', 'Invalid email or password');
    }

    public function create(UserForm $request){
        error_log('reached');
        $user = User::create($request->validated());
        return redirect()->route('user', [$user]);
    }
    /**
     * update $user with the given parameters in $requst
     * App\Http\Requests\UpdateUserForm will validate the data
     */
    public function user(UserForm $request, User $user){
        
        $user->fill(
            array_diff($request->validated(), array_flip(['password']))
        )->save();
        return redirect()->route('user', [$user]);
    }

    /**
     * remove $item from $user's cart
     */
    public function detach(Request $request, User $user, Item $item)
    {
        $user->cart()->detach($item);
    }
}
