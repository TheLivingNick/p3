<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScrabbleController extends Controller
{
  public function index()
  {
    return view('scrabble');
  }

  public function scoreWord()
  {
    return 'At this step we should score the entered word...';
    # redirect ...
  }
}
