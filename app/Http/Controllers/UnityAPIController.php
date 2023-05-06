<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UnityAPIController extends Controller
{
    // API for Unity

    public function test()
    {
        return 1;
    }

    // SignIn from Unity
    public function checkUser(Request $request)
    {
        $user = $request->username;
        $pass = $request->password;
        $check = DB::table('users')->where('username', $user)->first();

        if(!$check)
            return -1;

        $check_pass = Hash::check($pass, $check->password);

        if($check_pass) 
            return $check;
    }

    // Cron saving function
    public function cronSave(Request $request)
    {
        // Player data
        $player_id = $request->player_id;
        $buildIndex = $request->buildIndex;
        $hasPistol = $request->hasPistol;
        $hasAxe = $request->hasAxe;
        $health = $request->health;
        $x = $request->x;
        $y = $request->y;
        $z = $request->z;
        $progress = $request->progress;
        $monsterKilled = $request->monsterKilled;
        $deathCount = $request->deathCount;

        $user = User::find(intval($player_id));
        if($user)
        {
            // Update player data
            $user->buildIndex = $buildIndex;
            $user->hasPistol = $hasPistol;
            $user->hasAxe = $hasAxe;
            $user->health = $health;
            $user->x = $x;
            $user->y = $y;
            $user->z = $z;
            $user->progress = $progress;
            $user->monsterKilled = $monsterKilled;
            $user->deathCount = $deathCount;

            $user->save();

            return 1;
        }

        return 0;
    }
}
