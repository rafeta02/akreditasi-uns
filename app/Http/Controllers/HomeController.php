<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Jenjang;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function fakultas()
    {
        return view('frontend.fakultas');
    }

    public function prodi()
    {
        $jenjangs = Jenjang::all();
        return view('frontend.prodi', compact('jenjangs'));
    }

    public function detailProdi()
    {
        $jenjangs = Jenjang::all();
        return view('frontend.detail_prodi', compact('jenjangs'));
    }
}
