<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\PermissionRepository;
use Illuminate\Support\Facades\Redirect;

class PermissionsController extends Controller
{

    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->middleware(['role:super-administrator',
        'permission:create-permission|list-permissions|edit-permission|delete-permission']);
        $this->permission = new PermissionRepository($permission);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::query()->get();        
        return view('layouts.settings.roles-permissions.permissions.index',[
            "user" => Auth::user(),
            "permissions" => $permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.settings.roles-permissions.permissions.create',["user"=>Auth::user()]);
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

        $result = $this->permission->create($request->only($this->permission->getPermission()->fillable),$request->id);
        
        if(!$result){
            return Redirect::back()->withErrors("An error occured while storing record");
        }

        return redirect()->route('permissions');
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
        $permission = $this->permission->show($id);

        return view('layouts.settings.roles-permissions.permissions.edit',[
            "user"=>Auth::user(),
            "permission"=>$permission
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

        $result = $this->permission->update($request->only($this->permission->getPermission()->fillable),$request->id);
        
        if(!$result){
            return Redirect::back()->withErrors("An error occured while updating record");
        }

        return redirect()->route('permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->permission->delete($id);
        if(!$permission){
            return Redirect::back()->withErrors("Failed to delete permission");
        }

        return redirect()->route('permissions');
    }
}
