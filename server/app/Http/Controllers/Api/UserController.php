<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\Product;
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
        // return response()->json([
        //      'message' => 'Check Successfully',
        //  ], 201);
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
                    ->latest()->get();
        return response()->json([
            'bids'    => $bids,
            'message' => 'Users Bids Retrieved Successfully',
        ], 201);
    }

    public function getHomeItems($id){
        $bids = Bid::join('auctions', 'auctions.id', 'bids.auction_id')
                    ->join('products', 'products.id', 'auctions.product_id')
                    ->where('bids.user_id', $id)
                    ->select('bids.*', 'products.product_name')
                    ->get()
                    ->count();
        $products = Auction::join('products', 'products.id', 'auctions.product_id')
                    ->where('auctions.user_id', $id)
                    ->select('auctions.*', 'products.product_name')
                    ->get()
                    ->count();
        $payables = Auction::join('products', 'products.id', 'auctions.product_id')
                    ->where('auctions.user_id', $id)
                    ->select('auctions.*', 'products.product_name')
                    ->where('auctions.close_time', '<', Carbon::now())
                    ->where('auctions.paying_time', '>', Carbon::now())
                    ->get()
                    ->count();

           
            
        return response()->json([
        'bids' => $bids,
        'products' => $products,
        'payables' => $payables,
        'message' => 'Bidder Home Data Retrieved Successfully',
        ], 201);
    }

    public function getUserProducts($id){
        date_default_timezone_set("Asia/Dhaka");
        $products = Auction::join('products', 'products.id', 'auctions.product_id')
                            ->where('auctions.user_id', $id)
                            ->select('auctions.*', 'products.product_name')
                            ->latest()->get();
        return response()->json([
        'products'    => $products,
        'nowDatetime' => Carbon::now()->timezone('Asia/Dhaka'),
        'message' => 'Users Products Retrieved Successfully',
        ], 201);
    }

    public function getUserWinningProducts($id){
        date_default_timezone_set("Asia/Dhaka");
        $products = Auction::join('products', 'products.id', 'auctions.product_id')
                            ->where('auctions.user_id', $id)
                            ->select('auctions.*', 'products.product_name')
                            ->where('auctions.close_time', '<', Carbon::now())
                            ->where('auctions.paying_time', '>', Carbon::now())
                            ->latest()->get();
        return response()->json([
        'products'    => $products,
        'message' => 'Users Products Retrieved Successfully',
        ], 201);
    }

    public function payNow(Request $request){
        $user = User::find($request->user_id);
        if($user->deposit < $request->winner_bid)
        {
            return response()->json([
                'status' => false,
                'message' => 'Insufficient Funds!'
            ], 201);
        }
        $user->deposit = $user->deposit - $request->winner_bid;
        if($user->save())
        {
            $auction = Auction::find($request->auction_id);
            $auction->is_delivered = 1;
            if($auction->save())
            {
                $product = Product::find($auction->product_id);
                $product->is_sold = 1;

                if($product->save())
                {
                    return response()->json([
                        'status' => true,
                        'auction' => $auction,
                        'deposit' => $user->deposit,
                        'message' => 'Pay Now Success!'
                    ], 201);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Pay Now Error!'
                    ], 201);
                }

               
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Auction Delivery Status Set Error!'
                ], 201);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Price Reduction Error!'
            ], 201);
        }
        
        

    }

    public function declineProduct(Request $request){
        $obj = Bid::where('auction_id', $request->auction_id)
                    ->where('user_id', $request->user_id)
                    ->orderBy('bidding_price', 'DESC')
                    ->first();
        if($obj->delete())
        {
            $highest_bid = Bid::where('auction_id', $request->auction_id)
            ->orderBy('bidding_price', 'DESC')
            ->first();
            $obj = new Auction();
            $obj = $obj->find($request->auction_id);
            $obj->user_id = $highest_bid->user_id;
            $obj->winner_bid = $highest_bid->bidding_price;
            if($obj->save())
            {
                return response()->json([
                    'status' => true,
                    'message' => 'Product Declined!'
                ], 201);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Product Decline Error!'
                ], 201);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Bid Delete Error!'
            ], 201);
        }
        

    }

    public function deleteBidder($id){
        $user = User::find($id);
        if($user->delete()){
            return response()->json([
                'status' => true,
                'message' => 'Decline Bidder Success!'
            ], 201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Decline Bidder Error!'
            ], 201);
        }
    }

    public function bidProduct(Request $request)
    {
        $user = User::find($request->user_id);
        if(!isset($user))
        {
            return response()->json([
                'status' => false,
                'message' => 'Non-valid User!'
            ], 201);
        }
        if($user->is_approved != 1)
        {
            return response()->json([
                'status' => false,
                'message' => 'Not Eligible to Bid!'
            ], 201);
        }

        $is_running_auction = Auction::leftjoin('users', 'users.id', '=', 'auctions.user_id')
                            ->leftjoin('products', 'products.id', '=', 'auctions.product_id')
                            ->select('auctions.*', 'user_id AS uid','product_id AS pid','products.product_name','users.name','products.base_price')
                            ->where('close_time', '<', Carbon::now())
                            ->where('auctions.id', $request->auction_id)
                            ->first();
        
        if(isset($is_running_auction))
        {
            return response()->json([
                'status' => false,
                'message' => 'Auction Expired!'
            ], 201);
        }


        $winner_bid = Auction::find($request->auction_id);

        if(!isset($winner_bid)){
            $winner_bid = 0;
        }else{
            $winner_bid = $winner_bid->winner_bid;
        }                                    
        if(($user->deposit >= $request->expected_value*($request->percentage/100)) && 
        ($request->bidding_price > $request->base_price && 
        $request->bidding_price > $winner_bid)
        )
        {
            $obj = new Bid();
            $obj->user_id = $request->user_id;
            $obj->auction_id = $request->auction_id;
            $obj->bidding_price = $request->bidding_price;
            $obj->bidding_date = $request->bidding_date;
            // $obj->bidding_date = '11-11-21';
            if($obj->save())
            {
                $obj = new Auction();
                $obj = $obj->find($request->auction_id);
                $obj->user_id = $request->user_id;
                $obj->winner_bid = $request->bidding_price;
                if($obj->save()){
                    return response()->json([
                        'status' => true,
                        'auction' => $obj,
                        'message' => 'Bid placed Successfully'
                    ], 201);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Bid placed and Auction Result Update Error'
                    ], 201);
                }
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
                'deposit' => $obj->deposit,
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
        $users = User::where('role', 'bidder')->latest()->get();
        return response()->json([
            'bidders'    => $users,
            'message' => 'Bidders Data Retrieved Successfully',
        ], 201);
    }
    
}
