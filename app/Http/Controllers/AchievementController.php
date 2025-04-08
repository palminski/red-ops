<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\MoviePick;
use Illuminate\Support\Facades\Hash;

class AchievementController extends Controller
{



    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desc' => 'required',
            'file' => 'required',
        ]);



        $newAchievement = new Achievement();

        $newAchievement->name = $request->input('name');
        $newAchievement->description = $request->input('desc');
        $newAchievement->icon_name = $request->input('file');

        $newAchievement->save();

        return redirect()->back()->with('success', 'Achievement Added!');
    }

    public function assign($id, Request $request)
    {
        $request->validate([
            'achievementId' => 'required',
        ]);
        $achievement = Achievement::findOrFail($request->input('achievementId', ''));

        $user = User::findOrFail($id);
        // dd($user->achievements);

        if ($user->achievements->contains($achievement)) {
            return redirect()->route('admin.showUser', ['id' => $id])
                ->with('message', 'User already has this achievement.');
        }

        $user->achievements()->attach($achievement);

        return redirect()->route('admin.showUser', ['id' => $id])->with('success', 'achievement added!');
    }
}
