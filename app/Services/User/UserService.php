<?php

namespace App\Services\User;

use App\Helpers\WebResponses;
use App\Models\Setting;
use App\Models\User;
use App\Models\VendorShop;
use App\Traits\PHPCustomMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use Yajra\DataTables\Facades\DataTables;


/**
 * @property VendorShop vendorShopModel
 */
class UserService
{
    use PHPCustomMail;


    private static $instance;
    /**
     * @var User
     */
    private $userModel;
    /**
     * @var Setting
     */
    private $settings;

    private function __construct()
    {
        $this->userModel = new User();
        $this->settings = new Setting();
//        $this->vendorShopModel = new VendorShop();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new UserService();
        }
        return self::$instance;
    }

    public function getAllUsers($records = null)
    {
        if ($records != null) {
            return $this->userModel->latest()->take(5)->get();
        }
        return $this->userModel->orderBy('created_at', 'desc')->get();
    }


    public function datatable()
    {
        $users = $this->getAllUsers();

        return DataTables::of($users)
            ->editColumn('created_at', function ($data) {
                $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('m-d-Y');
                return $formattedDate;
            })
            ->editColumn('role', function ($data) {

                $roles = implode(', ', $data->getRoleNames()->toArray());
                return str_contains($roles, 'admin') ? 'admin' : ($data->getRoleNames()->count() > 1 ? 'Vendor' : 'User');

            })
            ->addColumn('action', function ($data) {
                $editRoute = route('admin.user.edit', ['user' => $data->id]);
                $deleteRoute = route('admin.user.destroy', ['user' => $data->id]);

                return $data->status == 0 ?
                    '<button type="button" id="' . $data->id . '" title="Inactivate" href="customer-activate/' . $data->id . '" class="btn btn-danger btn-sm activate" data-activate="1"><i class="fas fa-stop"></i></button>&nbsp;'
                    . '<a title="Edit" href="' . $editRoute . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;'
                    . '<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" data-delete="' . $deleteRoute . '"><i class="fa fa-trash"></i></button>'
                    :
                    '<button type="button" id="' . $data->id . '" title="Activate" href="customer-activate/' . $data->id . '" class="btn btn-success btn-sm activate" data-activate="0"><i class="fas fa-stop"></i></button>&nbsp;'
                    . '<a title="Edit" href="' . $editRoute . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp;'
                    . '<button title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm" data-delete="' . $deleteRoute . '"><i class="fa fa-trash"></i></button>';
            })
            ->rawColumns(['action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }


    public function createUser($userData)
    {
        $user = $this->userModel->create($userData);
        $user->assignRole($userData['role']);
        return $user;
    }

    public function getUser($userId)
    {
        return $this->userModel->find($userId);
    }

    public function updateUser($user, $userData)
    {
        if ($user) {
            if (isset($userData['shop_name'])) {
                $user->update($userData);
                $this->updateVendorShop($user, $userData);
            }

            if (isset($userData['current_password']) && $userData['current_password'] != null) {
                $this->updatePassword($user, $userData);
            } else {
                $user->update($userData);
            }


            if (isset($userData['image']) && $userData['image']->isValid()) {
                $this->checkUserImage($user, $userData['image']);

            }

        }
        return $user;
    }

    public function deleteUser($user)
    {
        if ($user) {
            $user->delete();
        }
    }

    public function addHashPassword($userData)
    {
        $userData['password'] = Hash::make($userData['password']);
        return $userData;
    }

    public function statusChange($user)
    {
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();
        return true;
    }


    public function updateVendorShop($user, $userData)
    {
        return $user->vendorShop()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $userData['shop_name'],
                'details' => $userData['details'],
                'register_number' => $userData['register_number'],
            ]
        );
    }

    public function updatePassword($user, $userData)
    {
        $currentPasswordCorrect = $this->checkPassword($userData['current_password']);

        if (!$currentPasswordCorrect) {
            return WebResponses::errorRedirectBack('Incorrect Current Password');
        }

        if (isset($userData['password']) && $userData['password'] != null) {
            if ($userData['change_password'] != $userData['password']) {
                return WebResponses::errorRedirectBack('Password not match ');
            }
            $updatePsw = $this->addHashPassword($userData);
            $user->update($updatePsw);
        } else {
            return WebResponses::errorRedirectBack('New Password Required ');

        }
    }

    public function checkPassword($psw)
    {
        return Hash::check($psw, Auth::user()->password);
    }

    public function checkUserImage($user, $image)
    {
        if ($user->hasMedia('images')) {
            $user->getFirstMedia('images')->delete();
        }
        // Add the new image to the 'images' collection
        $user->addMedia($image)->toMediaCollection('images');
    }

    public function getLoggedInUser()
    {
        return Auth::user();
    }

    public function checkConnectVendorAccount()
    {
        if ($this->getLoggedInUser()->stripe_account_id != null) {
            return true;
        }
        return false;
    }

    public function contactUs($data)
    {
        try {
            $webSupport = $this->settings->latest()->first();

            $html = "<p><strong>Name:</strong> " . $data['first_name'] . " " . $data['last_name'] . "</p>";
            $html .= "<p><strong>Email:</strong> " . $data['email'] . "</p>";
            $html .= "<p><strong>Phone:</strong> " . $data['phone'] . "</p>";
            $html .= "<p><strong>Message:</strong> " . $data['message'] . "</p>";
            $this->Help($data['email'], $webSupport->email, "Contact Form Submit", $html,
                $attachment ?? null, $attachmentName ?? null);
//            $this->customMail($data['email'], $webSupport->email, "Contact Support", $html);
            return true;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());

        }
    }

    public function helpFormSubmit($data)
    {
        try {
            $webSupport = $this->settings->latest()->first();

            $html = "<p><strong>Email:</strong> " . $data['email'] . "</p>";
            $html .= "<p><strong>Message:</strong> " . $data['message'] . "</p>";

            if (isset($data['attachment']) && !is_null($data['attachment'])) {
                $attachment = $data['attachment'];
                $attachmentName = $attachment->getClientOriginalName();
            }

            // Send the email
//            $this->customMail($data['email'], $webSupport->email, "Help Request", $html,
//                $attachment ?? null, $attachmentName ?? null);
            $this->Help($data['email'], $webSupport->email, "Help Request", $html,
                $attachment ?? null, $attachmentName ?? null);
            return true;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }


    public function Help($from, $to, $subject, $html, $attachment = null, $attachmentName = null)
    {

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'cpanel8.olivelogo.com'; // SMTP server
            $mail->SMTPAuth = true;                // Enable SMTP authentication
            $mail->Username = 'no-reply@free99us.com';    // SMTP username
            $mail->Password = 'tRyb74RvhK9R';    // SMTP password
            $mail->SMTPSecure = 'ssl';            // Enable SSL encryption
            $mail->Port = 465;                    // TCP port for SSL

            // Recipients
            $mail->setFrom($from);
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $html;

            // Attachments from request
            if ($attachment && $attachment->isValid()) {
                $mail->addAttachment($attachment->path(), $attachmentName);
            }

            $mail->send();
            return true;
        } catch (\Exception $e) {
            // Handle exceptions
            throw new \Exception($e->getMessage());
        }
    }


}
