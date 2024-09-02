<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\LoginController;

// homepage
Route::get('/', function () {
    return view('index');//welcome
});

// login
Route::get('/login', function () {
    // redirect to homepage with login form
    //return view('index');//welcome
    return redirect('/');
});
Route::post('/login', [LoginController::class, 'authenticate']);

// register
Route::post('/register', function (Request $request) {
    
    $request->session()->regenerate();

    $user = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ];

    DB::table('users')->insert($user);
    return redirect('/');
});

// logout
Route::get('/logout', function (Request $request){

    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
});

Route::get('/dashboard', function (Request $request){
    if (Auth::check()) {
        // The user is logged in...
        $user = json_decode(session('user'));//session('user');//json_decode(session('user'));
        //dd(session('user'));
        return "You're Authenticated as <b>".$user->name."</b> using <b><u>".$user->email."</u></b> with Authorization Level: <b>".$user->role."</b>. <a href='/logout'>Logout</a>";//.dd($user)//.dd(session("user"))
    } else {
        return redirect('/');
    }
    
})->middleware('auth');
