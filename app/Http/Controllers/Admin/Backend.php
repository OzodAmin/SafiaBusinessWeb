<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Role;
use App\Permission;

class Backend extends Controller
{
    public function __invoke()
    {
        // $currentUser = Auth::user();
        // $roleId = $currentUser->roles->first()->id;
        // $permissions =
        //     Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
        //     ->where("permission_role.role_id",$roleId)
        //     ->get();
        // return view('admin.index', compact('permissions'));
        return view('admin.index');
    }
}