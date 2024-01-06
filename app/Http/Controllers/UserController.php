<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{

    public function profile()
    {
        $rentLogs = RentLogs::with(['user', 'book'])->where('user_id', auth()->user()->id)->get();

        return view('profile', compact('rentLogs'));
    }

    public function index()
    {
        $users = User::where('role_id', 2)->where('status', 'active')->where('deleted_at', null)->get();
        return view('admin-feature.users.index', compact('users'));
    }

    public function registeredUser()
    {
        $registeredUsers = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('admin-feature.users.inactive', compact('registeredUsers'));
    }
    public function show($username)
    {

        $user = User::where('username', $username)->first();
        $rentLogs = RentLogs::with(['user','book'])->where('user_id', $user->id)->get();
        return view('admin-feature.users.detail', compact('user', 'rentLogs'));
    }

    public function approve($username)
    {
        $affectedRows = User::where('username', $username)->update([
            'status' => 'active',
        ]);

        if ($affectedRows > 0) {
            return redirect('users', )->with('status', 'User approved successfully!');
        }

        return redirect()->back()->with('status', 'User not found or already approved!');
    }

    public function delete($username)
    {
        $user = User::where('username', $username)->first();
        return view('admin-feature.users.ban', compact('user'));
    }

    public function destroy($username)
    {
        $user = User::where('username', $username)->first();

        if ($user) {
            $user->deleted_at = Carbon::now();
            $user->save();

            return redirect('/users')->with('status', 'User deleted successfully!');
        }

        return redirect('/users')->with('status', 'User not found or already deleted!');
    }

    public function deletedUsers()
    {
        $users = User::whereNotNull('deleted_at')->get();

        return view('admin-feature.users.ban-list', compact('users'));
    }

    public function restore($username)
    {
        User::where('username', $username)->update(['deleted_at' => null]);
        return redirect('/users')->with('status', 'Deleted at column cleared successfully!');

    }
}
