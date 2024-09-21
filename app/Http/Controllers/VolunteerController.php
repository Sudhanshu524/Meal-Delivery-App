<?php

namespace App\Http\Controllers;

use App\Models\MemberOrder;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    //index
    public function index(){
        $mealOrder = MemberOrder::get();
        return view('Users.Volunteer.volunteerIndex')->with(['order' => $mealOrder]);
    }

    //volunteer details page


    //volunteer choosing member
    public function volunteerMember(Request $request){
        $memberOrder = new MemberOrder();

        $memberOrder->user_id = $request->input('user_id');
        $memberOrder->partner_id = $request->input('partner_id');
        $memberOrder->member_id = $request->input('member_id');
        $memberOrder->meal_id = $request->input('meal_id');
        $memberOrder->delivery_address = $request->input('delivery_address');
        $memberOrder->save();

        return redirect()->route('volunteer#index');
    }
    public function volunteerDetails($id){
        $memberOrder = MemberOrder::where('id', $id)->first();
        //$mealData = Meal::FindorFail($id);
        //dd($mealData);
        return view('Users.Volunteer.volunteerDetails')->with(['memberOrder' => [$memberOrder]]);
    }
    public function deleteOrder($id){

        MemberOrder::where('id', $id)->delete(); //db data delete

        //project image folder delete
     
        return view('Users')->with(['orderDeleted' => "Order Placed Successfully"]);
    }
}
