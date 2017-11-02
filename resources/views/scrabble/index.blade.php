@extends('layouts.master')

@section('formAndResult')
  <form method="get" action='/'>

    <label for='userWord'>Enter word here: </label>
    <input type='text' class='monospace' name='userWord' id='userWord' size='18'
      maxlength='20' value='{{ (count($errors) > 0) ? old('userWord') : $userWord }}'> <!-- left maxLength as 20 so the mexLength:15 validation can be tested -->
    @if($errors->get('userWord'))
      <ul class="errorList">
          @foreach($errors->get('userWord') as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
    @endif

    <p>Are there any modifiers?</p>
    <label for='userWord'>No modifiers: </label>
    <input type='radio' name='bonusMult' value='noBonus' {{ ($bonusMult=='noBonus') ? 'CHECKED' : ''}}><br>
    <label for='userWord'>Double Wore Score: </label>
    <input type='radio' name='bonusMult' value='doubleScore' {{ ($bonusMult=='doubleScore') ? 'CHECKED' : ''}}><br>
    <label for='userWord'>Triple Word Score (nice!): </label>
    <input type='radio' name='bonusMult' value='tripleScore' {{ ($bonusMult=='tripleScore') ? 'CHECKED' : ''}}>

    <p>Should the "Used All Letters" bonus apply?</p>
    <label for='sevenBonus'>Apply bonus: </label>
    <input type='checkbox' name='sevenBonus' id='sevenBonus' {{ ($sevenBonus) ? 'CHECKED' : ''}}>

    <input type='submit' id='buttonSubmit' value='Find Score'>

  </form>

  <div class='{{ (count($errors) > 0) ? 'badResult' : $resultType }}'>
    @if (count($errors) > 0)
      <p>There is an error with the entry. Please fix and re-submit.</p>
    @elseif ($resultType == 'haveResult')
      <p>
      @foreach($wordArray as $currentLetter)<img class="tilePic"
        src="/images/letter-{{ $currentLetter }}.png" alt="{{ $currentLetter }}">@endforeach <!-- whitespace inserted when on multiple lines -->
      <br>is worth {{ $wordValue }} points</p>
    @else
      <p>This is where your score will display!</p>
    @endif
  </div>
@endsection
