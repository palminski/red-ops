<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MoviePick;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private bool $rabit = true;

    private function swapRabit()
    {
        $this->rabit = !$this->rabit;
        return $this->rabit;
    }

    public function index(Request $request)
    {
        $moviePicks = MoviePick::all()
                ->sortByDesc('created_at');

        return view(
            'home',
            [
                'moviePicks' => $moviePicks, 
            ]
        );
    }
}
