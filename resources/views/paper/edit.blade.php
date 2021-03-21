<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <title>Popierius</title>
</head>
<body>
    @include('header')
    <div class="store">
        
        <form action="{{route('paper.update', $paper)}}" method="post">
          <div class="storeInput">
            <label for="plotis">Plotis:</label><br>
            <input type="text" name="plotis" value="{{$paper->plotis}}">
          </div>
          <div class="storeInput">
            <label for="ilgis">Ilgis:</label><br>
            <input type="text" name="ilgis" value="{{$paper->ilgis}}"><br><br>
          </div>
          <div class="storeInput">
            <label for="medziaga">Medziaga:</label><br>
            <input type="text" name="medziaga" value="{{$paper->medziaga}}"><br><br>
          </div>
          <div class="storeInput">
            <label for="klijai">Klijai:</label><br>
            <input type="text" name="klijai" value="{{$paper->klijai}}"><br><br>
          </div>
          <div class="storeInput">
            <label for="kiekis">Kiekis:</label><br>
            <input type="text" name="kiekis" value="{{$paper->kiekis}}"><br><br>
          </div>
          <div class="edit_btns">
              <input  type="submit" value="Įvesti">
          </div>
          <div class="edit_btns">
            <a href="{{route('paper.info', $paper )}}">Info</a>
          </div>
            <div class="edit_btns">
              <a href="{{route('paper.destroy', $paper)}} ">Ištrinti</a>
            </div>
          @csrf
        </form>
      </div>
</body>
</html>