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
  @if (auth()->user()->permission_lvl<=10 || auth()->user()->permission_lvl>=1000)

@include('errors')


<button class="paperBtn" onclick="myFunction()">Prideti popieriu</button>
  <div class="container">

    <div id="store" class="store" style="display: none">
      <form action="{{route('paper.store')}}" method="post">
        <div class="storeInput">
          <label for="plotis">Plotis:</label><br>
          <input type="text" size="8" name="plotis" value="">
        </div>
        <div class="storeInput">
          <label for="ilgis">Ilgis:</label><br>
          <input type="text" size="8" name="ilgis" value=""><br><br>
        </div>
        <div class="storeInput">
          <label for="medziaga">Medziaga:</label><br>
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
          <input  type="submit" value="Submit">
          @csrf
        </div>
      </form>
    </div>

    @endif

    <h2 class="titleOne" style="padding: 0px">Popieriaus sarasas</h2>

    <form class="filter" action="{{route('paper.sort')}}" method="post">

      <label for="medziaga" >Filtruoti medziaga:</label>
      <select name="medziaga" >
        <option value="0">All</option>
          @foreach ($medz_arrs as $medz_arr)
          <option value="{{$medz_arr}}">{{$medz_arr}}</option>
        @endforeach
      </select>
      
      <label for="klijai" style="padding-left:20px">Filtruoti klijai:</label>
      <select name="klijai" id="klijai">
        <option value="0">All</option>
          @foreach ($klijai_arrs as $klijai_arr)
          <option value="{{$klijai_arr}}">{{$klijai_arr}}</option>
        @endforeach
      </select>
      
          <input type="submit" value="Submit"><br><br>
      @csrf
    </form>
    <br><br>
    <div class="firstTable" >
      <table>
          <tr>
              <th>Plotis</th>
              <th>Ilgis</th>
              <th>Medziaga</th>
              <th>Klijai</th>
              <th>Kiekis</th>
              <th>Paskutinis redagavimas</th>

              @if (auth()->user()->permission_lvl<=10 || auth()->user()->permission_lvl>=1000)

              <th>Keisti</th>
              <th>Info</th>
              <th>Istrinti</th>

              @endif

          </tr>
        
          @foreach ($papers as $paper)
          <tr>
            <form action="{{route('paper.update',$paper)}}" method="post">
            <td><input type="text" size="2" name="plotis" value="{{$paper->plotis}}"></td>
            <td><input type="text" size="2" name="ilgis" value="{{$paper->ilgis}}"></td>
            <td><input type="text" size="8" name="medziaga" value="{{$paper->medziaga}}"></td>
            <td><input type="text" size="2" name="klijai" value="{{$paper->klijai}}"></td>
            <td><input type="text" size="2" name="kiekis" value="{{$paper->kiekis}}"></td>
            <td><input type="text" size="16" name="updated_at" value="{{$paper->updated_at}}" readonly></td>
            @csrf

            @if (auth()->user()->permission_lvl<=10 || auth()->user()->permission_lvl>=1000)

              <td>
                <button type="submit">Save</button> 
              </td>
            </form>
            <td>
              <a href="{{route('paper.info', $paper )}}"><button>Info</button></a>
            </td>
              <td>
                <a href="{{route('paper.destroy', $paper)}} "><button>Delete</button></a>
              </td>

             @endif 


          </tr>
          @endforeach
        
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

</body>
</html>