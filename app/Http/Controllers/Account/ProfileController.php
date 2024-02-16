<?php

namespace App\Http\Controllers\Account;

use App\Helpers\APIResponse;
use App\Helpers\WebResponses;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UserRequest;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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


    public function show(User $user)
    {
        $countries = $this->countryModel->getCountries();
        $states = $this->stateModel->getStates();
        return view('dashboards.common.profile-settings', compact('user', 'countries',
            'states'));
    }


    public function update(Request $request, User $user)
    {
        try {
            $user = $this->userService->updateUser($user, $request->all());

            if ($user) {
                return redirect()->route('user.vendor.profile.edit', Auth::user()->id)
                    ->with('success', 'Updated Successfully');
            }
            return WebResponses::errorRedirectBack('User not found');
        } catch (\Exception $e) {
            return WebResponses::errorRedirectBack($e->getMessage());
        }
    }

    public function getStates($countryId)
    {
        $states = $this->stateModel->getStatesByCountry($countryId);
        return response()->json($states);
    }

}
