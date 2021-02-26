<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>Popieriaus sandelis</title>
    <style>
      .container{
        display: grid;
        grid-template-columns: 20px 1fr 5fr 1fr 20px;
        grid-template-rows: auto;
        grid-template-areas: 
        ". alert alert alert  ."
        ". . details .  ."
        ". . store .  ."
        ". h2 h2 h2 ."
        ". filtras filtras filtras ."
        ". lentele lentele lentele .";
      }
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: center;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
        .details{
          grid-area: details;
        }
        .store{
          padding: 20px;
          grid-area: store;
          display: flex;
          justify-content: center;
          align-items: center;
          width: 100%;
        }
        .lentele{
          grid-area: lentele;
          overflow-x:auto;
        }
        h2{
          grid-area: h2;
          text-align: center;
        }
        .ivestis{
          /* width: 200px; */
          padding: 0px 20px;
          float: left;
        }
        .btn_ivastis{
          float: left;
          display: flex;
          justify-content: center;
          align-items: center;
          margin-top: 20px;
          padding: 0px 20px;
        }
        .filtras{
          grid-area: filtras;
          text-align: center;
        }
        header{
          height: 40px;
          background-color: aliceblue;
        }
        .alert{
            grid-area: alert;
            font-size: 15px;
            color: red;
            width: 100%;
            /* height: 30px; */
            display: flex;
            align-items: center;
            justify-content: center;
          }
          .alert-info{
            grid-area: alert;
            font-size: 15px;
            color: yellow;
            
          }
          .alert-success{
            grid-area: alert;
            font-size: 15px;
            color: green;
            
          }
    </style>
</head>
<body>

  
  @auth
  @if (auth()->user()->status!=0 )
  @if (auth()->user()->permission_lvl<=10 || auth()->user()->permission_lvl>=1000)
@include('header')
@include('errors')


<button onclick="myFunction()">Prideti popieriu</button>
  <div class="container">

    <div id="store" class="store" style="display: none">
      <form action="{{route('paper.store')}}" method="post">
        <div class="ivestis">
          <label for="plotis">Plotis:</label><br>
          <input type="text" size="8" name="plotis" value="">
        </div>
        <div class="ivestis">
          <label for="ilgis">Ilgis:</label><br>
          <input type="text" size="8" name="ilgis" value=""><br><br>
        </div>
        <div class="ivestis">
          <label for="medziaga">Medziaga:</label><br>
          <input type="text" size="8" name="medziaga" value=""><br><br>
        </div>
        <div class="ivestis">
          <label for="klijai">Klijai:</label><br>
          <input type="text" size="8" name="klijai" value=""><br><br>
        </div>
        <div class="ivestis">
          <label for="kiekis">Kiekis:</label><br>
          <input type="text" size="8" name="kiekis" value=""><br><br>
        </div>
        <div class="btn_ivastis">
          <input  type="submit" value="Submit">
          @csrf
        </div>
      </form>
    </div>
    

    
    
    
    
    


    @endif

    <h2>Popieriaus sarasas</h2>

    <form class="filtras" action="{{route('paper.sort')}}" method="post">

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
    <div class="lentele" >
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