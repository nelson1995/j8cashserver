<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use App\Repositories\PermissionRepository;

class RoleController extends Controller
{

    protected $role;
    protected $permission;

    public function __construct(Role $role,Permission $permission)
    {
        $this->middleware(['role:super-administrator','permission:create-role|list-roles|view-role|edit-role|delete-role']);
        $this->role = new RoleRepository($role); 
        $this->permission = new PermissionRepository($permission); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $roles = $this->role->all();
        return view('layouts.settings.roles-permissions.roles.index',[
            "user" => Auth::user(),
            "roles" => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.settings.roles-permissions.roles.create',[
            "user" => Auth::user(),"permissions"=>Permission::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                                       
        $this->validate($request,[
            'name'=>'required',
        ]);
        $result = $this->role->create($request->only($this->role->getRole()->fillable));
        
        if(!$result){
            return Redirect::back()->withErrors("An error occured while storing record");
        }

        return redirect()->route('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->role->show($id);
        $permissions = $this->permission->all();
        // foreach($permissions as $permission){
        //     if($role->permissions->contains($permission->id)){
        //        print_r($role->permissions->pluck('name'));
        //     }else{
        //         print_r("");
        //     }
        // }
        // die();
        return view('layouts.settings.roles-permissions.roles.edit',[
            "user"=>Auth::user(),
            "role" => $role,
            "permissions"=>$permissions
        ]);      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        
        $result = $this->role->update($request->only($this->role->getRole()->fillable),$request->id);
        
        if(!$result){
            return Redirect::back()->withErrors("An error occured while updating record");
        }

        return redirect()->route('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->role->delete($id);
        if(!$role){
            return Redirect::back()->withErrors("Failed to delete role/");
        }

        return redirect()->route('roles');
    }
}
