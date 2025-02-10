<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $users = User::orderBy('id','DESC')->paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create', [
            'roles' => Role::pluck('name')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        $user = User::create($input);
        if($request->has('roles') && $request->roles[0]!=null)
           $user->assignRole($request->roles);
        else
            $user->assignRole('Student');

        return redirect()->route('users.index')
                ->withSuccess('New user is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $user->roles->pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
                'name' => 'required|string|max:250',
                'email' => 'required|string|email:rfc,dns|max:250|unique:users,email,'.$user->id,
                'password' => 'nullable|string|min:8|confirmed',
            ]
        );

        $input = $request->all();

        if(!empty($request->password)){
            $input['password'] = Hash::make($request->password);
        }else{
            $input = $request->except('password');
        }

        $user->update($input);

        if(!$request->has('from')){
            if($request->has('roles') && $request->roles[0]!=null)
                $user->syncRoles($request->roles);
            else
                $user->assignRole('Student');

        }

        if($request->has('from')){
            return redirect()->route('profile')->withSuccess('Profile updated successfully.');
        }
        return redirect()->route('users.index')->withSuccess('User updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->hasRole('Super Admin')){
            return redirect()->route('users.index')->withError('You can not delete Super Admin user.');
        }
        $user->syncRoles([]);
        $user->delete();
        return redirect()->route('users.index')->withSuccess('User is deleted successfully.');
    }

    public function profile_index(): View
    {
        return view('users.profile', [
            'user' => auth()->user()
        ]);
    }
}
