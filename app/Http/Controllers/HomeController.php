<?php


namespace App\Http\Controllers;


use App\Models\Export_Rig;
use App\Models\PCCase;

class HomeController
{
    public function index()
    {
        $top8=Export_Rig::latest()->take(8)->get();
        return view('index',['rigs'=>$top8]);
    }
}
