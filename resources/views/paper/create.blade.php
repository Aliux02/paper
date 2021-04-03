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
    
    <div class="container">
        <div class="row" style="padding: 10px">
        @include('errors')
        </div>
        <div class="row ">
          <div class="col-12 paperEdit">
            <form action="{{route('paper.store')}}" method="get">
              <div class="storeInput">
                <label for="plotis">Plotis:</label><br>
                <input type="text" name="plotis" value="{{old('plotis')}}"><br><br>
              </div>
              <div class="storeInput">
                <label for="ilgis">Ilgis:</label><br>
                <input type="text" name="ilgis" value="{{old('ilgis')}}"><br><br>
              </div>
              <div class="storeInput">
                <label for="medziaga">Medziaga:</label><br>
                <input type="text" name="medziaga" value="{{old('medziaga')}}"><br><br>
              </div>
              <div class="storeInput">
                <label for="klijai">Klijai:</label><br>
                <input type="text" name="klijai" value="{{old('klijai')}}"><br><br>
              </div>
              <div class="storeInput">
                <label for="kiekis">Kiekis:</label><br>
                <input type="text" name="kiekis" value="{{old('kiekis')}}"><br><br>
              </div>
              <div class="edit_btns" style="margin-bottom: 20px">
                  <input  type="submit" value="Įvesti">
              </div>
              {{-- <div class="edit_btns">
                <a href="{{route('paper.info', $paper )}}">Info</a>
              </div>
                <div class="edit_btns">
                  <a href="{{route('paper.destroy', $paper)}} ">Ištrinti</a>
                </div> --}}
              @csrf
            </form>
          </div>
        </div>
    </div>
</body>
</html>