<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Following;
use App\Notification;
use Illuminate\Http\Request;
use App\Http\Requests;

class FollowController extends Controller
{
    /**
     * registers a new follower on acceptance of invitation request
     * @param String $email
     */
    public function agree($user_id, $user_name, $email){
        if(Follower::where('user_id', $user_id)->where('email', $email)->first()){
            return redirect('/')->with(['follow' => 'You are already following '.$user_name.' on iPub', 'followHeader' => 'Invitation Already Accepted']);
        }
        // create a follower model in the database and retrieve it or retrieve it directly if it alredy exists
        $follower = Follower::firstOrCreate(['user_id' => $user_id, 'email' => $email]);
        // notify account user of the invitation request being accepted
        $notification = new Notification();
        $notification->user_id = $user_id;
        $notification->body = "The invitation request you sent to ".$email." has been accepted.<br />".$email." is now one of your followers.";
        $notification->status = 0;
        $notification->on_board = 0;
        $notification->save();
        // insert records in the following table
        $following = new Following();
        $following->follower_id = $follower->id;
        $following->user_id = $user_id;
        $following->save();

        return redirect('/')->with(['follow' => 'You are now following '.$user_name.' on iPub', 'followHeader' => 'Follow Status Confirmed']);
    }
}
