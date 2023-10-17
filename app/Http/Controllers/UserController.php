<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\UserManagementService;

class UserController extends Controller
{
    private UserManagementService $userService;
 
    public function __construct(UserManagementService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $total = User::count();
        return $this->createSuccessResponse(compact('total'));
    }

 
    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        $result = $this->userService->updateOrInsertUsersData($request);
        
        return $this->createSuccessResponse(compact('result'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
