<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Auction\StoreAuctionRequest;
use App\Http\Requests\Auction\UpdateAuctionRequest;
use App\Models\Auction;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auctions = DB::table('auctions')
        ->leftjoin('products','products.id' , '=', 'auctions.product_id')
        ->get();
        $status     = $auctions->count() ? true : false;
        return response()->json([   
            'data'   => $auctions,
            'status' => $status,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function PastAuction()
    {
        date_default_timezone_set("Asia/Dhaka");
        $auctions = DB::table('auctions')
        ->leftjoin('users', 'users.id', '=', 'auctions.user_id')
         ->leftjoin('products', 'products.id', '=', 'auctions.product_id')
         ->select('auctions.*', 'user_id AS uid','product_id AS pid','products.product_name','users.name','products.base_price')
        ->where('close_time', '<', Carbon::now())
        ->latest()->get();
        $auctions1 = DB::table('auctions')
        ->where('paying_time', '<', Carbon::now())
        ->get();
        $result = $auctions1->count() ? true : false;
        $status = $auctions->count() ? true : false;
        return response()->json([   
            'data'   => $auctions,
            'status' => $status,
            'result' => $result
        ]);
    }
    public function UpcomingAuction()
    {
        date_default_timezone_set("Asia/Dhaka");
        $auctions = DB::table('auctions')
         ->leftjoin('products', 'products.id', '=', 'auctions.product_id')
         ->select('auctions.*', 'product_id AS pid','products.product_name','products.base_price','products.expected_value','products.percentage', 'products.front_image', 'products.category_id')
        ->where('auctions.start_time', '>', Carbon::now())
        ->latest()->get();
        
        $status = $auctions->count() ? true : false;
        return response()->json([   
            'data'   => $auctions,
            'status' => $status,
        ]);
    }

    public function RunningAuction()
    {
        date_default_timezone_set("Asia/Dhaka");
        $auctions = DB::table('auctions')
            ->leftjoin('products', 'products.id', '=', 'auctions.product_id')
            ->select('auctions.*', 'product_id AS pid','products.product_name','products.base_price','products.expected_value','products.percentage', 'products.front_image', 'products.category_id')
            ->where('close_time', '>=', Carbon::now())
            ->where('start_time', '<=', Carbon::now())
            ->latest()->get();
        
        $status = $auctions->count() ? true : false;
        return response()->json([   
            'data'   => $auctions,
            'now' => date("Y-m-d H:i:s"),
            'status' => $status,
        ]);
    }
    
    public function updateAuctionStatus($id)
    {
        $admin_id=1;
        $auctions=Auction::find($id);
        $user_id = $auctions->user_id;
        $product_id = $auctions->product_id;
        $users = User::find($user_id);
        $admin = User::find(1);
        $products = Product::find($product_id);
        $userdeposit = $users->deposit;
        $admindeposit = $admin->deposit;
        $percentage = $products->percentage;
        $price = $products->base_price;
        $vat = ($percentage*$price)/100;
        Auction::where('is_delivered', 0)
                 ->update(['is_delivered' => 2]);
        User::where('id', $user_id)
        ->update(['deposit' => $userdeposit-$vat]);
        User::where('id', 1)
        ->update(['deposit' => $admindeposit+$vat]);
        Product::where('id', $product_id)
        ->update(['is_sold' => 2]);
        
    }
    public function getauctiondetails($id)
    { 
        date_default_timezone_set("Asia/Dhaka");
        $auctions = DB::table('auctions')
        ->leftjoin('users', 'users.id', '=', 'auctions.user_id')
        ->leftjoin('products', 'products.id', '=', 'auctions.product_id')
        ->select('auctions.*', 'user_id AS uid','product_id AS pid','products.product_name',
        'products.front_image','products.back_image','products.left_image',
        'products.right_image','products.description','users.name','products.base_price',
        'products.specification', 'products.percentage', 'products.expected_value', 'users.name as user_name')
        ->where('auctions.id', '=', $id)
        ->get();

        // ->where('auctions.start_time', '>', Carbon::now())
        foreach($auctions as $auction)
            $can_bid = $auction->start_time < Carbon::now() ? true : false;
       
        $status = $auctions->count() ? true : false;
        return response()->json([   
            'data'   => $auctions,
            'can_bid' => $can_bid,
            'status' => $status,
            
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuctionRequest $request)
    {
        $auction = Auction::create(
            $request->validated());

        $status = $auction ? true : false;

        return response()->json([
            'data'   => $auction,
            'status' => $status,
            'message' => 'Auction Added Successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuctionRequest $request, Auction $auction)
    {
        $status = $auction->update($request->validated());

        return response()->json([
            'status' => $status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Auction::find($id);
        if($obj->delete())
        {
            return response()->json([
                'status' => true,
                'message' => 'Auction Deleted'
            ], 201);
        }else{
            return response()->json([
                'status' => false,
                'messsage' => 'Auction Delete Error'
            ], 400);
        }
    }
}
