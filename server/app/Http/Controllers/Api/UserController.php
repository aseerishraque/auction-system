<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use App\Models\Auction;
use App\Services\SaveImageService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return $request->user();
    }

    public function store(StoreUserRequest $request)
    {
        $request->validated();
        if($request->account_type == 'personal')
            $attributes = ['nid_front_img', 'nid_back_img'];
        else
            $attributes = ['nid_front_img', 'nid_back_img', 'vat_img'];

        $image_attributes = (new SaveImageService)
            ->saveImage($request, $attributes, $request->email, 'images/user/info/')
            ->get();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->mobile_no = $request->mobile_no;
        $user->account_type = $request->account_type;
        $user->nid_no = $request->nid_no;
        $user->nid_front_img = $image_attributes['nid_front_img'];
        $user->nid_back_img = $image_attributes['nid_back_img'];
        if($request->account_type != 'personal')
        {
            $user->vat_no = $request->vat_no;
            $user->vat_img = $image_attributes['vat_img'];
        }
        $user->save();
        $status = $user ? true : false;
        return response()->json([
           'data'    => $user,
           'status' => $status,
            'message' => 'Registered Successfully',
        ], 201);
    }

    public function updateBidder(StoreUserRequest $request, $id)
    {
        $request->validated();
        if($request->account_type == 'personal')
            $attributes = ['nid_front_img', 'nid_back_img'];
        else
            $attributes = ['nid_front_img', 'nid_back_img', 'vat_img'];

        $image_attributes = (new SaveImageService)
            ->saveImage($request, $attributes, $request->email, 'images/user/info/')
            ->get();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->mobile_no = $request->mobile_no;
        $user->account_type = $request->account_type;
        $user->nid_no = $request->nid_no;
        $user->nid_front_img = $image_attributes['nid_front_img'];
        $user->nid_back_img = $image_attributes['nid_back_img'];
        if($request->account_type != 'personal')
        {
            $user->vat_no = $request->vat_no;
            $user->vat_img = $image_attributes['vat_img'];
        }
        $user->save();
        $status = $user ? true : false;
        return response()->json([
           'data'    => $user,
           'status' => $status,
            'message' => 'Registered Successfully',
        ], 201);
    }

    public function getBidder($id)
    {
        $user = User::where('id', $id)->first();
        if($user)
        {
            return response()->json([
                'bidder' => $user,
                'message' => 'Bidder Data Retrieved'
            ], 201);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Bidder Data Not Found'
            ], 401);
        }
    }

    public function getBidders(){
        $users = User::where('role', 'bidder')->get();
        return response()->json([
            'bidders'    => $users,
            'message' => 'Bidders Data Retrieved Successfully',
        ], 201);
    }
    
}
