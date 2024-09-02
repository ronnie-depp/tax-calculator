<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
 
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        //$request->session()->regenerate();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //$credentials['is_active'] = 1;
 
        if (Auth::attempt($credentials)) {
            
            // initialize new session
            $request->session()->regenerate();
            // Retrieve the currently authenticated user...
            $user = Auth::user();
            $user_id = Auth::id();
            //echo "$user_id / Auth::id() : ".dd($user_id);
            $user = User::where('id', $user_id)->with('roles')->get();
            //array
            $userObj = json_decode($user);
            //object
            $userObj = $userObj[0];
            $userObj->role = $userObj->roles[0]->role;
            //dd($userObj->scalar);
            //$userObj = (object) $userObj->scalar;
            //dump($userObj[0]->name);
            
            // Roles
            //$roles = $userObj->roles;//User::where('id', $user_id)->roles()->get();//$user->roles()->get();
            //dd($roles[0]->role);
            $allRoles = Role::all();
            $allUsersWithRoles = User::all();
            // store in session
            session(["email" => "$request->email", "isLoggedIn" => true, "userRole" => "$userObj->role"]);
            session(["user" => json_encode($userObj)]);
            $_SESSION["user"] = $userObj;
            return redirect('/dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}