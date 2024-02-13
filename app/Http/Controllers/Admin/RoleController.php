<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebResponses;
use App\Services\Admin\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\admin\RoleRequest;

class RoleController extends AdminBaseController
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        $roles = $this->roleService->getAllRoles();
        if ($request->ajax()) {
            return $this->roleService->datatable();
        }
        return view('admin.pages.roles.index', compact('roles'));
    }


    public function create()
    {
        $roles = $this->roleService->getAllRoles();
        $permissions = $this->roleService->getAllPermissions();

        return view('admin.pages.roles.create', compact('roles', 'permissions'));
    }


    public function store(Request $request)
    {
        try {
            $this->roleService->createRole($request->all());
            return WebResponses::successRedirect('admin.roles.index', 'Role Added successfully');

        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }


    public function show(Role $role)
    {
        $roles = $this->roleService->getAllRoles();
        $permissions = $this->roleService->getAllPermissions();
        return view('admin.pages.roles.edit', compact('role', 'roles', 'permissions'));
    }


    public function update(RoleRequest $request, Role $role)
    {
        $role = $this->roleService->updateRole($role, $request->all());
        if ($role) {
            return WebResponses::successRedirect('admin.roles.index', 'Role Updated successfully');
        }
        return WebResponses::errorRedirectBack('Role not found');
    }


    public function destroy(Role $role)
    {
        $this->roleService->deleteRole($role);
        return WebResponses::successRedirect('admin.roles.index', 'Role Deleted successfully');

    }


}
