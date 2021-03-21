<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <title>Popieriaus sandelis</title>
</head>
<body>

@include('header')
  @auth
  @if (auth()->user()->status!=0 )
  
    

  <div class="container">

    
    

  {{-- <button class="paperBtn" onclick="myFunction()">Prideti popierių</button> --}}
    {{-- <div id="store" class="titleOne" > --}}

      {{-- <form action="{{route('paper.store')}}" method="get">
        <div class="storeInput">
          <label for="plotis">Plotis:</label><br>
          <input type="text" size="8" name="plotis" value="">
        </div>
        <div class="storeInput">
          <label for="ilgis">Ilgis:</label><br>
          <input type="text" size="8" name="ilgis" value=""><br><br>
        </div>
        <div class="storeInput">
          <label for="medziaga">Medžiaga:</label><br>
          <input type="text" size="8" name="medziaga" value=""><br><br>
        </div>
        <div class="storeInput">
          <label for="klijai">Klijai:</label><br>
          <input type="text" size="8" name="klijai" value=""><br><br>
        </div>
        <div class="storeInput">
          <label for="kiekis">Kiekis:</label><br>
          <input type="text" size="8" name="kiekis" value=""><br><br>
        </div>
        <div class="btn_store">
          <input  type="submit" value="Įvesti">
        </div>
        @csrf
      </form> --}}
    {{-- </div> --}}
    
    <div  class="row">
      @include('errors')
      @if (auth()->user()->permission_lvl<=10 || auth()->user()->permission_lvl>=1000)
      <a class="col-2" href="{{route('paper.create')}}">Prideti popierių</a>
      @endif
      <form class="filter col-12 "action="{{route('paper.sort')}}" method="post">
        <div  style="padding:10px">
          <label for="medziaga" >Medžiaga:</label>
          <select name="medziaga" >
            <option value="0">All</option>
              @foreach ($medz_arrs as $medz_arr)
              <option value="{{$medz_arr}}">{{$medz_arr}}</option>
            @endforeach
          </select>
        </div>

        <div  style="padding:10px">
          <label for="klijai" >Klijai:</label>
          <select name="klijai" id="klijai">
            <option value="0">All</option>
              @foreach ($klijai_arrs as $klijai_arr)
              <option value="{{$klijai_arr}}">{{$klijai_arr}}</option>
            @endforeach
          </select>
        </div>
        <div class="filterBtn" style="padding:10px">
          <input type="submit" value="Submit"><br><br>
        </div>
              
          @csrf
        
        </form>
      </div>


    

    <div class="secondTable row" >


      <div class="header col-12">Popieriaus sąrasas </div>
      
      <table class="paper col-12">
        <thead>
          <tr>
              <th>Plotis</th>
              <th>Ilgis</th>
              <th>Medžiaga</th>
              <th>Klijai</th>
              <th>Kiekis</th>
              {{-- <th>Paskutinis redagavimas</th> --}}

              @if (auth()->user()->permission_lvl<=10 || auth()->user()->permission_lvl>=1000)

              <th>Keisti</th>
              {{-- <th>Info</th>
              <th>Ištrinti</th> --}}

              @endif

          </tr>
        </thead>
        <tbody>
          @foreach ($papers as $paper)
          <tr onclick="window.location='{{route('paper.edit',$paper)}}'">
            <form action="{{route('paper.update',$paper)}}" method="post">
            <td>{{$paper->plotis}}</td>
            <input type="hidden" name="plotis" value="{{$paper->plotis}}"></td>
            <td>{{$paper->ilgis}}</td>
            <input type="hidden" name="ilgis" value="{{$paper->ilgis}}">
            <td>{{$paper->medziaga}}</td>
            <input type="hidden" name="medziaga" value="{{$paper->medziaga}}">
            <td>{{$paper->klijai}}</td>
            <input type="hidden" name="klijai" value="{{$paper->klijai}}">
            <td onclick="tdclick(event);"><input type="text" size="2" name="kiekis" value="{{$paper->kiekis}}"></td>
            {{-- <td>{{$paper->updated_at}}</td> --}}
            @csrf

            @if (auth()->user()->permission_lvl<=10 || auth()->user()->permission_lvl>=1000)

              <td onclick="tdclick(event);">
                <button type="submit">Išsaugoti</button> 
              </td>
            </form>
            {{-- <td onclick="tdclick(event);">
              <a href="{{route('paper.info', $paper )}}"><button>Info</button></a>
            </td>
              <td onclick="tdclick(event);">
                <a href="{{route('paper.destroy', $paper)}} "><button>Ištrinti</button></a>
              </td> --}}

             @endif 


          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    
    @endif
    @endauth
  </div>

  <script>
    function myFunction() {
      var x = document.getElementById("store");
      if (x.style.display === "flex") {
        x.style.display = "none";
      } else {
        x.style.display = "flex";
      }
    }
  </script>
  <script>
    function tdclick(event){
        console.log(''); 
        event.stopPropagation()
    };
  </script>
</body>
</html>