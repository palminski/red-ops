<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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


        $formData = $request->session()->get('formData', []);

        $users = User::select('username')->get();

        return view(
            'home',
            [
                'users' => $users,
                'formData' => $formData
            ]
        );
    }
}
