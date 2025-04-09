<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function  register(Request $req)
    {
        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return $user;
    }

    function login(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if(!$user || !Hash::check($req->password, $user->password))
        {
            return ["error" => "Email or password is incorrect"];
        }
        return $user;
    }

    function logout(Request $req)
    {
        $req->user()->tokens()->delete();
        return ["message" => "Logged out"];
    }

    function getUser(Request $req)
    {
        return $req->user();
    }

    function updateUser(Request $req, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        
        $user->name = $req->name;
        $user->email = $req->email;
        $user->save();
        
        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    function getUsers()
    {
        return User::all();
    }

    function getUserById($id)
    {
        return User::find($id);
    }

    function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    function getUserByName($name)
    {
        return User::where('name', $name)->first();
    }
}

