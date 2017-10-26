@extends('layouts.master')

@section('formAndResult')
  <form method="get" action='/'>

    <?php #dump($request); ?>

    <label for='userWord'>Enter word here: </label>
    <input type='text' class='monospace' name='userWord' id='userWord' size='18' maxlength='20' value='{{ old('userWord') }}'> <!-- left maxLength as 20 so the mexLength:15 validation can be tested -->
    @if($errors->get('userWord'))
      <ul>
          @foreach($errors->get('userWord') as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
    @endif

    <p>Are there any modifiers?</p>
    <label for='userWord'>No modifiers: </label>
    <input type='radio' name='bonusMult' value='noBonus' {{ ($noBonus) ? 'CHECKED' : ''}}><br>
    <label for='userWord'>Double Wore Score: </label>
    <input type='radio' name='bonusMult' value='doubleScore' {{ ($doubleScore) ? 'CHECKED' : ''}}><br>
    <label for='userWord'>Triple Word Score (nice!): </label>
    <input type='radio' name='bonusMult' value='tripleScore' {{ ($tripleScore) ? 'CHECKED' : ''}}>

    <p>Should the "Used All Letters" bonus apply?</p>
    <label for='sevenBonus'>Apply bonus: </label>
    <input type='checkbox' name='sevenBonus' id='sevenBonus' {{ ($sevenBonus) ? 'CHECKED' : ''}}>

    <input type='submit' id='buttonSubmit' value='Find Score'>

  </form>

  <div class='{{ (count($errors) > 0) ? 'badResult' : $resultType }}'>
    @if (count($errors) > 0)
      <p>There is an error with the entry. Please fix and re-submit.</p>
    @else
      <p>The word is worth {{ $wordValue }} points</p>
    @endif
  </div>
@endsection
