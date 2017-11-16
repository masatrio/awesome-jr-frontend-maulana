<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class HomeController extends Controller
{
  public function show($nama)
  {
    return view('repo',
    ['name' => $nama]
    );
  }
}
