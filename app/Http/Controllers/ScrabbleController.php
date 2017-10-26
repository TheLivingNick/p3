<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScrabbleController extends Controller
{
  public function index(Request $request)
  {
    $letterValuesJSON = file_get_contents('../database/letterValues.json');
    $letterValues = json_decode($letterValuesJSON, true);

    $userWord = $request->input('userWord', null);
    $wordValue = 0;
    $wordArray = [];
    $resultType = 'noResult';

    if ($userWord){
      $this->validate($request, [
          'userWord' => 'required|min:2|max:15|alpha'
      ]);

      $resultType = 'haveResult';
      $wordArray = str_split($userWord);
      foreach($wordArray as $letter) {
        $wordValue += $letterValues[strtolower($letter)];
      }
    }

    return view('scrabble.index')->with([
        'request' => $request,
        'userWord' => $userWord,
        'noBonus' => $request->has('noBonus'),
        'doubleScore' => $request->has('doubleScore'),
        'tripleScore' => $request->has('tripleScore'),
        'sevenBonus' => $request->has('sevenBonus'),
        'wordValue' => $wordValue,
        'resultType' => $resultType
    ]);
  }
}
