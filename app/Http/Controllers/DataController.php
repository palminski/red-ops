<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataController extends Controller
{

    public function showForm()
    {
        return view(
            'data'
        );
    }

    public function handleSubmit(Request $request)
    {
        //handle submission here
        $inputData = $request->all();

        //do something with the data
        //store data ina the session
        $request->session()->put('formData', $inputData);

        //Redirect or return a view
        return redirect()->route('show-data')->with('status', 'Success! Data submitted!');
    }

    public function showData(Request $request)
    {
        $formData = $request->session()->get('formData', []);

        return view(
            'show-data',
            ['formData' => $formData]
        );
    }

    public function clearSession(Request $request) {
        $request->session()->flush();

        return redirect('/')->with('status', 'Session was cleared!');
    }
}
