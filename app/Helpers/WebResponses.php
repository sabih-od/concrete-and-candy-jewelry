<?php

namespace App\Helpers;

trait WebResponses
{
    public static function successRedirect($route, $message)
    {
        return redirect()->route($route)->with('success', $message);
    }

    public static function successRedirectBack($message)
    {
        return redirect()->back()->with('success', $message);
    }

    public static function errorRedirectBack($errorMessage)
    {
        return redirect()->back()->with('error', $errorMessage);
    }

    public static function errorRedirectSpecificRoute($route, $errorMessage)
    {
        return redirect()->route($route)->with('error', $errorMessage);
    }
}
