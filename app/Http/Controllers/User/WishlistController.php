<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\{Http\Controllers\Controller, Models\Product, Models\Wishlist};
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{

    public function wishlists(Request $request)
    {
        $sort = '';
        $pageby = $request->pageby;
        $user = Auth::user();
        $wishes = Wishlist::where('user_id', '=', $user->id)->pluck('product_id');
        $page_count = isset($pageby) ? $pageby : '';


        if (!empty($request->sort)) {
            $sort = $request->sort;
            if ($sort == "id_desc") {
                $wishlists = Product::where('status', '=', 1)->whereIn('id', $wishes)->latest('id')->paginate($page_count);
            } else if ($sort == "id_asc") {
                $wishlists = Product::where('status', '=', 1)->whereIn('id', $wishes)->paginate($page_count);
            } else if ($sort == "price_asc") {
                $wishlists = Product::where('status', '=', 1)->whereIn('id', $wishes)->oldest('price')->paginate($page_count);
            } else if ($sort == "price_desc") {
                $wishlists = Product::where('status', '=', 1)->whereIn('id', $wishes)->latest('price')->paginate($page_count);
            }
            if ($request->ajax()) {
                return view('front.ajax.wishlist', compact('user', 'wishlists', 'sort', 'pageby'));
            }
            return view('front.pages.wishlist', compact('user', 'wishlists', 'sort', 'pageby'));
        }

        $wishlists = Product::where('status', '=', 1)->whereIn('id', $wishes)->latest('id')->paginate($page_count);
        if ($request->ajax()) {
            return view('frontend.ajax.wishlist', compact('user', 'wishlists', 'sort', 'pageby'));
        }
        return view('front.pages.wishlist', compact('user', 'wishlists', 'sort', 'pageby'));
    }

    public function addwish($id)
    {
        $user = Auth::user();
        $data[0] = 0;
        $ck = Wishlist::where('user_id', '=', $user->id)->where('product_id', '=', $id)->get()->count();
        if ($ck > 0) {
            $data['error'] = __('Already Added To The Wishlist.');
            return redirect()->back()->with($data);
        }
        $wish = new Wishlist();
        $wish->user_id = $user->id;
        $wish->product_id = $id;
        $wish->save();
        $data[0] = 1;
        $data[1] = count($user->wishlists);
        $data['success'] = __('Successfully Added To The Wishlist.');
        return redirect()->back()->with($data);

    }

    public function removewish($id)
    {
        $user = Auth::user();
        $wish = Wishlist::findOrFail($id);
        $wish->delete();
        $data[0] = 1;
        $data[1] = count($user->wishlists);
        $data['success'] = __('Successfully Removed From Wishlist.');
//        return response()->json($data);
        return redirect()->back()->with($data);

    }

}
