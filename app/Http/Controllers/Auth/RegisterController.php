<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
   */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $role;
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }
    
    /* 
        create a new user repository instance
    */

    public function __construct(Role $role)
    {
        $this->role = new RoleRepository($role);
    }

    /**
     * Show the application registration form.
     *
     */
    public function showRegistrationForm()
    {
        return view('layouts.auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $data = $request->all();
        $this->validator($data)->validate();
        try {
            $this->createUser($data);
            return redirect('/');
        } catch (Exception $ex) {
            return Redirect::back()->withErrors("Registration failed");
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required | string | max:255',
            'username' => 'required | string | max:255 | unique:users',
            'email' => 'required | email | unique:users',
            'phone' => 'required | numeric | digits:10 |unique:users',
            'password' => 'required | string | min:8',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function createUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role'=>'',
            'password' => Hash::make($data['password']),
        ]);

        $role = $this->role->getRoleByName("administrator");
        $user->assignRole($role);
        return $user;
    }
}
