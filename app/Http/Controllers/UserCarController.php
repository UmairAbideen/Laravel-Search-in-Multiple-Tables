<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Car;
use App\Models\Group;
use Illuminate\Http\Request;

class UserCarController extends Controller
{

    public function index(Request $request)
    {
        // Get all groups for the dropdown
        $groups = Group::all();

        // Get users filtered by group if selected
        $users = User::query();
        if ($request->filled('group_id')) {
            $users->where('group_id', $request->group_id);
        }
        $users = $users->get();

        // Get selected user and their cars if a user is selected
        $selectedUser = null;
        if ($request->filled('user_id')) {
            $selectedUser = User::with('cars')->find($request->user_id);
        }

        // Return the view with data
        return view('index', compact('groups', 'users', 'selectedUser'));
    }



    // Method to fetch users by selected group
    public function getUsersByGroup(Request $request)
    {
        // Fetch users for the given group
        $groupId = $request->group_id;
        $users = User::where('group_id', $groupId)->get();

        // Return a response with the users
        return response()->json(['users' => $users]);
    }


    public function search(Request $request)
    {
        $groups = Group::all();

        $users = User::when($request->has('group_id') && $request->group_id, function ($query) use ($request) {
            return $query->where('group_id', $request->group_id);
        })->get();

        $selectedUser = null;
        if ($request->has('user_id') && $request->user_id) {
            $selectedUser = User::with('cars')->find($request->user_id);
        }

        return view('index', compact('users', 'selectedUser', 'groups'));
    }


    public function showAddGroupForm()
    {
        return view('add-group');
    }


    public function storeGroup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Group::create([
            'name' => $request->name,
        ]);

        return redirect()->route('home')->with('success', 'Group added successfully.');
    }


    public function showAddUserForm()
    {
        // Fetch all groups to display in the form
        $groups = Group::all();
        return view('add-user', compact('groups'));
    }


    public function storeUser(Request $request)
    {
        // Validate incoming request, including the group_id
        $request->validate([
            'name' => 'required|string|max:255',
            'group_id' => 'required|exists:groups,id', // Ensure the group_id exists in the groups table
        ]);

        // Create the user with the provided group_id
        User::create([
            'name' => $request->name,
            'group_id' => $request->group_id,  // Add the group_id in the creation process
        ]);

        // Redirect back with a success message
        return redirect()->route('home')->with('success', 'User added successfully.');
    }


    public function showAddCarForm()
    {
        // Get all groups for the dropdown
        $groups = Group::all();

        // Pass the groups to the view
        return view('add-car', compact('groups'));
    }

    public function storeCar(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
        ]);

        // Store the car data
        Car::create([
            'user_id' => $request->user_id,
            'make' => $request->make,
            'model' => $request->model,
        ]);

        return redirect()->route('home')->with('success', 'Car added successfully.');
    }

}
