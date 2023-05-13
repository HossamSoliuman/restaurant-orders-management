<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Traits\ApiResponse;

class RoleController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $roles = Role::with(['users' => function ($query) {
            $query->paginate(5);
        }])->get();
    
        return $this->successResponse(RoleResource::collection($roles));
    }
    
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());
    
        return $this->successResponse(RoleResource::make($role));    
    }
    
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
    
        return $this->successResponse(RoleResource::make($role));
    }
    
    public function destroy(Role $role)
    {
        $role->delete();
    
        return $this->customResponse([], 'Successfully deleted');  
    }
}
