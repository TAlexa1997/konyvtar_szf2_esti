<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $copies = response()->json(User::all());
        return $copies;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->Hash::make($request->password);
        $user->permission = $request->permission;
        $user->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$id)
    {
        $copies = response()->json(User::all());
        return $copies;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->Hash::make($request->password);
        $user->permission = $request->permission;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
