<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): View
    {
        return view('permissions.index', [
            'permissions' => Permission::orderBy('id','DESC')->paginate(15)
        ]);
    }

    public function store()
    {
        Permission::all()->each->delete();
        Artisan::call('permission:create-permission-routes');
        return redirect()->route('permissions.index')->withSuccess('New permissions are added successfully.');
    }



}
