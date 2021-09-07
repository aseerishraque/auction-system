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

    public function store(Request $request)
    {
        return response()->json([
            'Info'    => $request->nid_front_img,
            'message' => 'Registered Successfully',
        ], 201);
        
        $attributes = ['nid_front_img', 'nid_back_img', 'vat_img'];

        $image_attributes = (new SaveImageService)
            ->saveImage($request, $attributes, $request['email'], 'images/user/info/')
            ->get();

        try{
            $user = User::create(array_merge($request, $image_attributes));
            return response()->json([
                'data'    => $user,
                'message' => 'Registered Successfully',
            ], 201);
        }
        catch(Exception $e){
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
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
