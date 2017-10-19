<?php
require('helpers.php');
require('Form.php');

# Create asscociative array of letter values from JSON
$letterValuesJSON = file_get_contents('../database/letterValues.json');
$letterValues = json_decode($letterValuesJSON, true);
$wordForm = new DWA\Form($_GET);
$resultType = 'noResult';

# if a word was entered, keep it after submit, otherwise default to empty string
$userWord = $wordForm->get('userWord', '');

# if the multiplier was changed from noBonus use the value in $_GET, other default to noBonus
$bonusMult = $wordForm->get('bonusMult', 'noBonus');

# if the 7-letter bonus box was checked keep the check, otherwise default to blank
$sevenBonus = $wordForm->get('sevenBonus') == 'on' ? 'CHECKED' : '';

# if the form has been submitted, validate
if ($wordForm->isSubmitted()) {
  $allErrors = $wordForm->validate(['userWord' => 'required|alpha|minLength:2|maxLength:15']);
}

# if there is an error, display it
# if there are no errors, then computes the value of the word
if ($wordForm->hasErrors) {
  $resultType = 'badResult';
} else {
  $wordValue = 0;
  $wordArray = str_split($userWord);

  # loop through each letter and add its value to the total
  if ($wordForm->isSubmitted()){ # needed to prevent null call to letter
    foreach($wordArray as $letter) {
      $wordValue += $letterValues[strtolower($letter)];
    }
  }

  # apply multipliers if there are any
  if ($bonusMult == 'doubleScore') {
    $wordValue += $wordValue;
  } elseif ($bonusMult == 'tripleScore') {
    $wordValue = $wordValue * 3;
  } else {
    $wordValue = $wordValue;
  }

  # if the Used All Letters bonus is checked and the word is long enough add the bonus
  if ($sevenBonus == 'CHECKED' && strlen($userWord) >= 7) {
    $wordValue += 50;
  }

  # if a word was scored set result area to haveResult - keeps initial page load from having error state
  if ($wordForm->isSubmitted()) {
    $resultType = 'haveResult';
  }
}
