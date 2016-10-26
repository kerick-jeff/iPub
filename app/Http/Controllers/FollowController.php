<?php

namespace App\Http\Controllers;

use App\User;
use App\Follower;
use App\Notification;
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests;

class FollowController extends Controller
{
    /**
     * registers a new follower on acceptance of invitation request
     * @param String $email
     */
    public function agree($user_id, $user_name, $email){
        //check if database entry already exists
        $follower = Follower::where('user_id', $user_id)
                    ->where('email', $email)->first();
        if($follower){
            return redirect('/')->with(['follow' => 'You are already following '.$user_name.' on iPub', 'followHeader' => 'Invitation Already Accepted']);
        }

        $user = User::find($user_id);
        $follower = new Follower();
        $follower->user_id = $user_id;
        $follower->email = $email;
        $user->followers()->save($follower);

        //create a folder for the visitor
        Storage::disk('followers')->makeDirectory($email);

        // notify account user of the invitation request being accepted
        $notification = new Notification();
        $notification->user_id = $user_id;
        $notification->body = "The invitation request you sent to ".$email." has been accepted.<br />".$email." is now one of your followers.";
        $notification->status = 0;
        $notification->on_board = 0;
        $notification->save();

        // add on board notification for the iPub user account

        return redirect('/')->with(['follow' => 'You are now following '.$user_name.' on iPub', 'followHeader' => 'Follow Status Confirmed']);
    }
}
