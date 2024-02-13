<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\APIResponse;
use App\Helpers\WebResponses;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Requests\admin\UserRequest;
use Illuminate\Support\Facades\DB;

class UserController extends AdminBaseController
{

    protected $userService;
    protected $countryModel;
    protected $stateModel;

    public function __construct(UserService $userService, Country $countryModel, State $stateModel)
    {
        $this->userService = $userService;
        $this->countryModel = $countryModel;
        $this->stateModel = $stateModel;
    }

    public function index(Request $request)
    {
        $users = $this->userService->getAllUsers();

        if ($request->ajax()) {
            return $this->userService->datatable();
        }

        return view('admin.pages.users.index', compact('users'));
    }

    public function create()
    {
        $countries = $this->countryModel->getCountries();
        $states = $this->stateModel->getStates();
        return view('admin.pages.users.create', compact('countries', 'states'));
    }

    public function getStatesByCountry(Request $request)
    {
        $countryId = $request->input('country');
        $country = $this->countryModel->getCountriesById($countryId);
        if (!$country) {
            return APIResponse::success("404 | Not Found", []);

        }
        $states = $country->states;
        return APIResponse::success("States Retrieved Successfully", $states->toArray());
    }

    public function store(UserRequest $request)
    {
        try {

            DB::beginTransaction();

            $userData = $this->userService->addHashPassword($request->all());
            $this->userService->createUser($userData);

            DB::commit();
            return WebResponses::successRedirect('admin.users.index', 'User Added successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function show(User $user)
    {
        $countries = $this->countryModel->getCountries();
        $states = $this->stateModel->getStates();
        return view('admin.pages.users.edit', compact('user', 'countries', 'states'));
    }

    public function update(UserRequest $request, User $user)
    {
        $userData = $this->userService->addHashPassword($request->all());
        $user = $this->userService->updateUser($user, $userData);
        if ($user) {
            return WebResponses::successRedirect('admin.users.index', 'User Updated successfully');
        }
        return WebResponses::errorRedirectBack('User not found');
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return WebResponses::successRedirect('admin.users.index', 'User Deleted successfully');
    }

    public function changeUserStatus(User $user)
    {
        $this->userService->statusChange($user);
        return APIResponse::success();
    }

}
