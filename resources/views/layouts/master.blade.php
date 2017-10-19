<?php require('scrabbleLogic.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>DWA15 Project 3</title>
  <link rel="stylesheet" href="css/scrabbleScore.css">
</head>
<body>

  <img src="images/scrabble-letters.jpg" alt="Scrabble Letters" height="277" width="333">

  <h1>Scrabble Score Calculator</h1>
  <h3>Want to find the value of a word? Enter it below, set the modifiers, and hit the button to find out!</h3>

  <form method="get">

    <label for='userWord'>Enter word here: </label>
    <input type='text' class='monospace' name='userWord' id='userWord' size='18' maxlength='20' value='<?=sanitize($userWord)?>'> <!-- left maxLength as 20 so the mexLength:15 validation can be tested -->

    <p>Are there any modifiers?</p>
    <label for='userWord'>No modifiers: </label>
    <input type='radio' name='bonusMult' value='noBonus' <?php if ($bonusMult == "noBonus") echo 'CHECKED'?>><br>
    <label for='userWord'>Double Wore Score: </label>
    <input type='radio' name='bonusMult' value='doubleScore' <?php if ($bonusMult == "doubleScore") echo 'CHECKED'?>><br>
    <label for='userWord'>Triple Word Score (nice!): </label>
    <input type='radio' name='bonusMult' value='tripleScore' <?php if ($bonusMult == "tripleScore") echo 'CHECKED'?>>

    <p>Should the "Used All Letters" bonus apply?</p>
    <label for='sevenBonus'>Apply bonus: </label>
    <input type='checkbox' name='sevenBonus' id='sevenBonus' <?=$sevenBonus?>>

    <input type='submit' id='buttonSubmit' value='Find Score'>

  </form>

	<section>
		@yield('wordArea')
	</section>

</body>
</html>
