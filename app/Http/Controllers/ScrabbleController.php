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
    $bonusMult = $request->input('bonusMult', 'noBonus');
    $wordValue = 0;
    $wordArray = [];
    $resultType = 'noResult';

    if ($_GET){
      $this->validate($request, [
          'userWord' => 'required|min:2|max:15|alpha'
      ]);

      $resultType = 'haveResult';
      $wordArray = str_split($userWord);
      foreach($wordArray as $letter) {
        $wordValue += $letterValues[strtolower($letter)];
      }

      if($bonusMult == 'doubleScore') {
        $wordValue += $wordValue;
      }

      if($bonusMult == 'tripleScore') {
        $wordValue = $wordValue * 3;
      }

      if($request->has('sevenBonus') && strlen($userWord) >= 7) {
        $wordValue += 50;
      }
    }

    return view('scrabble.index')->with([
        'request' => $request,
        'userWord' => $userWord,
        'bonusMult' => $bonusMult,
        'sevenBonus' => $request->has('sevenBonus'),
        'wordValue' => $wordValue,
        'resultType' => $resultType,
        'wordArray' => $wordArray
    ]);
  }
}
