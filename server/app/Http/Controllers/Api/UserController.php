<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use App\Models\Auction;
use App\Models\Bid;
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

    public function updateBidder(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'confirmed',
            'mobile_no' => 'required|min:10',
            'account_type' => 'required',
            'nid_no' => 'required'
        ]);
        $attributes = [];
        
        if(substr($request->nid_front_img, 0, 10) === 'data:image'){
            array_push($attributes, 'nid_front_img');
        }
        if(substr($request->nid_back_img, 0, 10) === 'data:image'){
            array_push($attributes, 'nid_back_img');
        }
        if(substr($request->vat_img, 0, 10) === 'data:image'){
            array_push($attributes, 'vat_img');
        }
        if(count($attributes) > 0){
            $image_attributes = (new SaveImageService)
            ->saveImage($request, $attributes, $request->email, 'images/user/info/')
            ->get();
        }
        
        $user = new User();
        $user = $user->find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(isset($request->password))
          $user->password = $request->password;
        $user->mobile_no = $request->mobile_no;
        $user->account_type = $request->account_type;
        $user->nid_no = $request->nid_no;
        if(isset($image_attributes['nid_front_img']))
            $user->nid_front_img = $image_attributes['nid_front_img'];
        if(isset($image_attributes['nid_back_img']))
            $user->nid_back_img = $image_attributes['nid_back_img'];
        if($request->account_type != 'personal')
        {
            $user->vat_no = $request->vat_no;
            if(isset($image_attributes['vat_img']))
                $user->vat_img = $image_attributes['vat_img'];
        }
        $user->save();
        $status = $user ? true : false;
        return response()->json([
           'data'    => $user,
           'status' => $status,
            'message' => 'Bidder Information Updated Successfully',
        ], 201);
    }

    public function approveBidder($id, $is_approved){
        $user = new User();
        $user = $user->find($id);
        $user->is_approved = $is_approved;
        $user->save();
        $status = $user ? true : false;
        return response()->json([
           'data'    => $user,
           'status' => $status,
           'message' => $user->name."'s Approval Updated"
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

    public function getUserBids($id){
        $bids = Bid::join('auctions', 'auctions.id', 'bids.auction_id')
                    ->join('products', 'products.id', 'auctions.product_id')
                    ->where('bids.user_id', $id)
                    ->select('bids.*', 'products.product_name')
                    ->get();
        return response()->json([
            'bids'    => $bids,
            'message' => 'Users Bids Retrieved Successfully',
        ], 201);
    }

    public function getUserProducts($id){
        $products = Auction::join('products', 'products.id', 'auctions.product_id')
                            ->where('auctions.user_id', $id)
                            ->select('auctions.*', 'products.product_name')
                            ->get();
        return response()->json([
        'products'    => $products,
        'message' => 'Users Products Retrieved Successfully',
        ], 201);
    }

    public function bidProduct(Request $request)
    {
        $user = User::find($request->user_id);
        if($user->deposit >= $request->bidding_price)
        {
            $obj = new Bid();
            $obj->user_id = $request->user_id;
            $obj->auction_id = $request->auction_id;
            $obj->bidding_price = $request->bidding_price;
            $obj->bidding_date = $request->bidding_date;
            // $obj->bidding_date = '11-11-21';
            if($obj->save())
            {
                return response()->json([
                    'status' => true,
                    'message' => 'Bid placed Successfully'
                ], 201);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Bid place error'
                ], 201);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Insufficient Funds!'
            ], 201);
        }
        
    }

    public function deposit(Request $request)
    {
        $obj = new User();
        $obj = $obj->find($request->user_id);
        $obj->deposit = $obj->deposit + $request->deposit;
        if($obj->save())
        {
            return response()->json([
                'status' => true,
                'message' => 'Deposit Added Successfully'
            ], 201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Deposit Add error'
            ], 201);
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
