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
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
class AdminController extends Controller
{ 
    public function Allcount()
    {
        $users = User::where('role','=','bidder')->count();
        $categories = Category::all()->count();
        $products = Product::all()->count();
        $past_auctions = Auction::where('close_time', '<', Carbon::now())->count();
        $upcoming_auctions = Auction::where('auctions.start_time', '>', Carbon::now())->count();
        $running_auctions = Auction::where('close_time', '>=', Carbon::now())
                                    ->where('start_time', '<=', Carbon::now())->count();
        return response()->json([   
            'users'   => $users,
            'categories' => $categories,
            'products' => $products,
            'past_auctions'   => $past_auctions,
            'upcoming_auctions' => $upcoming_auctions,
            'running_auctions' => $running_auctions,
        ]);
    }

    public function AllAuction()
    {
        $auctions = DB::table('auctions')
        ->leftjoin('users', 'users.id', '=', 'auctions.user_id')
         ->leftjoin('products', 'products.id', '=', 'auctions.product_id')
         ->select('auctions.*', 'product_id AS pid','products.product_name','users.name','products.base_price')
        ->get();
        
        $status = $auctions->count() ? true : false;
        return response()->json([   
            'data'   => $auctions,
            'status' => $status,
        ]);
    }
}

    