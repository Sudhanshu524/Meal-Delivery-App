<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Meal;
use App\Models\Member;
use App\Models\MemberOrder;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        //
        $mealOrder = Meal::get();
        return view('Users.Member.memberIndex')->with(['order' => $mealOrder]);
    }

    public function memberDetails($id){
        $mealOrder = Meal::where('id', $id)->first();
        //$mealData = Meal::FindorFail($id);
        //dd($mealData);
        return view('Users.Member.memberDetails')->with(['mealOrder' => [$mealOrder]]);
    }
    public function addOrder(){
        $partner_data = Partner::get();
        $member_data = Member::get();
        $meal_data = Meal::get();
        $user_data = User::get();
        return view('Users.Member.addOrder')->with(['partnerData' => $partner_data, 'memberData' => $member_data,'mealData' => $meal_data, 'userData' => $user_data]);
    }

    public function createOrder(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'delivery_address' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $order = new MemberOrder();

        $order->delivery_address = $request->input('delivery_address');
        $order->partner_id = $request->input('partner');
        $order->user_id = $request->input('user');
        $order->member_id = $request->input('member');
        $order->meal_id = $request->input('meal');
        $order->save();
        return view('Users.Member.ThankYou')->with(['Order Placed', 'Order Placed Sucessfully']);
    }
}
