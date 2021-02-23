<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title>Speech synthesiser</title>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/web-speech-api-speech-synthesis.css') }}">
  </head>
  <body>
    <h1>Speech synthesiser</h1>
    <p>Enter some text in the input below and press return  or the "play" button to hear it. change voices using the dropdown menu.</p>
    <form>
      <input type="text" class="txt">
      <div>
        <label for="rate">Rate</label><input type="range" min="0.5" max="2" value="1" step="0.1" id="rate">
        <div class="rate-value">1</div>
        <div class="clearfix"></div>
      </div>
      <div>
        <label for="pitch">Pitch</label><input type="range" min="0" max="2" value="1" step="0.1" id="pitch">
        <div class="pitch-value">1</div>
        <div class="clearfix"></div>
      </div>
      <select>
        <option data-lang="en-US" data-name="Microsoft Zira Desktop - English (United States)">Microsoft Zira Desktop - English (United States) (en-US) -- DEFAULT</option>        
      </select>
      <div class="controls">
        <button id="play" type="submit">Play</button>
      </div>
    </form>
    <script src="{{ URL::asset('assets/js/web-speech-api-speech-synthesis.js') }}"></script>
  </body>
</html> 