<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use Carbon\Carbon;
use App\PhoneVerification;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use AfricasTalking\SDK\AfricasTalking;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    protected $user;
    protected $role;
    
    public function __construct(User $user,Role $role)
    {
        $this->user = new UserRepository($user);
        $this->role = new RoleRepository($role); 
    }

    /*
     * return the details of user logged in dashboard
     *
     * @return view
     * */
    public function index()
    {
        return view('layouts.settings.profile.index',[
            "user" => Auth::user()
        ]);
    }

    /*
     * display list of registered app users
     * @return view
     * */
    public function showUsers()
    {
        $users = $this->user->getUsersByRole("user");
        $users->load('country');
        return view('layouts.settings.users.index',[
            "user" => Auth::user(),
            "users"=>$users
        ]);
    }

    public function showAgents()
    {
        $agents = $this->user->getUsersByRole("administrator");
        $agents->load('country');
        return view('layouts.settings.agents.index',[
            "user" => Auth::user(),
            "agents"=>$agents
        ]);
    }

    public function editAgent($id)
    {
        $agent = $this->user->show($id);
        $roles = Role::get();
        $countries=Country::get();
        // dd($agent->country->pluck('country'));
        
        return view('layouts.settings.agents.edit',[
            "user" => Auth::user(),
            "roles"=>$roles,
            "agent"=>$agent,
            "countries"=>$countries
        ]);
    }
    public function editUser($id)
    {
        $user = $this->user->show($id);
        $countries=Country::get();
        $roles = Role::get();   
        return view('layouts.settings.users.edit',[
            "user" => Auth::user(),
            "users"=>$user,
            "roles"=>$roles,
            "countries"=>$countries
        ]);
    }
    
    public function edit($id)
    {
        $user = $this->user->show($id);
        return view('layouts.settings.user.edit',[
            "user" => Auth::user(),
            "users"=>$user
        ]);
    }

    public function updateAgent(Request $request)
    {   
        $request->validate([
            'fullname'=>'required',
            'username'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'email' => 'required|string|email',
            'role'=>'required'
        ]);

        $user = User::query()->where('id',$request->id)->first();

        $user->name = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        if(!$user){
            return Redirect::back()->withErrors("Failed to update profile");
        }
        $role = Role::findorFail($request->role)->first();
        $user->removeRole($role->name);
        $user->assignRole($role);
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $user->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('agents');
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'fullname'=>'required',
            'username'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'email' => 'required|string|email',
            'points' =>'required',
            'role'=>'required',
            'country'=>'required'
        ]);

        $user = User::query()->where('id',$request->id)->first();
        $country = Country::query()->where('country', $request->country)->first();
        $user->name = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->points = $request->points;
        $user->save();
        if(!$user){
            return Redirect::back()->withErrors("Failed to update profile");
        }
        $role = Role::findorFail($request->role)->first();
        $user->removeRole($role->name);
        $user->assignRole($role);
        $user->country()->detach();
        $user->country()->attach($country);
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $user->addMediaFromRequest('image')->toMediaCollection('images');
        }
        return redirect()->route('users');
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'fullname'=>'required',
            'username'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'email' => 'required|string|email'
        ]);

        $user = User::query()->where('id',$request->id)->first();

        $user->name = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        if(!$user){
            return Redirect::back()->withErrors("Failed to update profile");
        }

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $user->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('home');
    }



    // API ACTIONS
    public function get_users()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return response()->json($users);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        $user->load('country');

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'phone' => $user->phone,
            'pin' => $user->pin,
            'country' => $user->country[0]->country,
            'country_code' => $user->country[0]->country_code,
            'phone_code' => $user->country[0]->phone_code,
            'currency' => $user->country[0]->currency,
            'wallet' => $user->wallet,
            'invite_code' => $user->invite_code,
            'points' => $user->points,
            "profile_pic_url" => $user->profilePicture(),
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'phone' => ['required', 'string'],
            'country' => ['required'],
        ]);

        $country = Country::query()->where('country', $request->country)->first();
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->pin = "0000";
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->invite_code = $this->generateInviteCode();
        $user->points = 0;
        $user->wallet = 0;
        $user->role = "";
        $user->save();
        
        $role = $this->role->getRoleByName("user");
        $user->assignRole($role);
        
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        $user->country()->attach($country);

        $user->load('country');
        
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'phone' => $user->phone,
            'pin' => $user->pin,
            'country' => $user->country[0]->country,
            'country_code' => $user->country[0]->country_code,
            'phone_code' => $user->country[0]->phone_code,
            'currency' => $user->country[0]->currency,
            'wallet' => $user->wallet,
            'invite_code' => $user->invite_code,
            'points' => $user->points,
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function create_pin(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            $user->pin = $request->pin;
            $user->save();

            return response()->json(['status' => 1, 'message' => 'PIN has been created successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'User does not exist']);
        }
    }

    public function change_pin(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->pin = $request->pin;
            $user->save();

            return response()->json(['status' => 1, 'message' => 'PIN has been changed successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'User does not exist']);
        }
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        return response()->json([
            "user" => $request->user(),
            "profile_pic_url" => $user->profilePicture()
        ], 200);
    }

    public function update_profile(Request $request)
    {
        $user = Auth::user();
        $users = User::where('email', $request->email)->get();
        // $response = [];
        if (count($users) > 0 && $users[0]->email != $user->email) {
            $response = [
                'status' => 0,
                'message' => "Email already exists"
            ];
        } else {

            $user->name = $request->name;
            $user->email = $request->email;
            // $user->phone = $request->phone;
            $user->username = $request->username;
            $user->save();
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $user->addMediaFromRequest('image')->toMediaCollection('images');
            }
        $role = $this->role->getRoleByName("user");
        $user->assignRole($role);

            $response = [
                'status' => 1,
                'message' => "Profile updated successfully",
                'data' => $user,
                "profile_pic_url" => $user->profilePicture()
            ];
        }

        return response()->json($response);
    }

    public function wallet()
    {
        $user = Auth::user();
        return response()->json($user->wallet);
    }

    function generateRandomCode($length = 4)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generateInviteCode($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIKLMNOPRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function verify_phone(Request $request)
    {
        $phone = $request->phone;
        $code = $this->generateRandomCode();

        $model = PhoneVerification::where('phone', $phone)->first();

        if (!$model) {
            $model = new PhoneVerification;
            $model->phone = $phone;
        }

        $model->code = $code;
        $model->is_verified = 0;
        $model->save();


        // Add AfricaIsTalkingApi
        // $username = 'sandbox'; // use 'sandbox' for development in the test environment
        // $apiKey   = 'fcd26c318eeea8a73edf9f6b4ec56dc187526f3e14aab37e5bbae143614a9144';

        $username = "benrapha";
        $apiKey = "44d6b88d9310cb04b02fe414837d2d5b49b6a7d5ac6b0e0c5c3766e34807e7df";

        $AT       = new AfricasTalking($username, $apiKey);
        // Get one of the services
        $sms      = $AT->sms();

        // Use the service
        $result   = $sms->send([
            'to'      => $phone,
            'message' => 'Your J8Cash verifcation code is ' . $code,
        ]);

        if ($result['status'] == "success") {
            $response = [
                'status' => 1,
                'message' => "Code has been sent successfully",
                'phone' => $phone
            ];
        } else {
            $response = [
                'status' => 0,
                'message' => "Verification code was not sent to this number"
            ];
        }
        return response()->json($response);
    }

    public function confirm_code(Request $request)
    {
        $phone = PhoneVerification::where('phone', $request->phone)->first();
        if ($phone->code == $request->code) {
            $phone->is_verified = 1;
            $phone->save();
            $response = [
                'status' => 1,
                'message' => "Phone has been verified"
            ];
        } else {
            $response = [
                'status' => 0,
                'message' => "Verification code is incorrect"
            ];
        }

        return response()->json($response);
    }
    /*
     *  To reward user a point
     *  get the invite code sent by the new user and compare it to invite codes stored
     *  in database
     * */
    public function rewardPoints(Request $request)
    {
        $request->validate([
            'invite_code' => 'required'
        ]);

        $users = User::query()->get();
        foreach ($users as $user) {
            if ($user->invite_code === $request->invite_code) {
                $user->invite_code = $this->generateInviteCode();
                $user->points = $user->points + 1;
                $user->save();
                $response = [
                    'status' => 200,
                    'message' => "Invitation code verified"
                ];
            } else {
                $response = [
                    'status' => 403,
                    'message' => "Invitation code not found."
                ];
            }
        }
        return response()->json($response);
    }
}
