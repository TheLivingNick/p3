<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScrabbleController extends Controller
{
  public function index()
  {
    $letterValuesJSON = file_get_contents('../database/letterValues.json');
    $letterValues = json_decode($letterValuesJSON, true);

    return view('scrabble.index');
  }
}
