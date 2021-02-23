<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>Archyvas</title>
    <style>
        body,
        body * {
            margin: 0;
            padding: 0;
            vertical-align: top;
            box-sizing: border-box;
            font-family:'Times New Roman', Times, serif;
            
        }
          .container{
            display: grid;
            grid-template-columns: 20px 1fr 5fr 1fr 20px;
            grid-template-rows: auto;
            grid-template-areas:     
            ". . store .  ."
            ". h2 h2 h2 ."
            ". filtras filtras filtras ."
            ". lentele lentele lentele ."
            "lia lia lia lia lia"
            ". lentele1 lentele1 lentele1 .";
          }
          table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
          }
          
          td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
          }
          
          tr:nth-child(even) {
            background-color: #dddddd;
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
          .lentele1{
            grid-area: lentele1;
            overflow-x:auto;
          }
          h2{
            grid-area: h2;
            text-align: center;
          }
          .lia{
            grid-area: lia;
            text-align: center;
          }
          .ivestis{
            /* width: 200px; */
            height: 38px;
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
          input::-webkit-datetime-edit{ color: transparent; }
          input:focus::-webkit-datetime-edit{ color: #000; }
          /* input::-webkit-calendar-picker-indicator {
              display: none;
              -webkit-appearance: none;
            } */
  
        </style>
</head>
<body>

  @auth
  @if (auth()->user()->status!=0 )
  @if (auth()->user()->permission_lvl>=750)
    <header>
        <a href="{{route('welcome')}}"><button>Atgal</button></a>
    </header>
    <div class="container">
    <h2 class="lia">Archyvas</h2>
    <br>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Iveskite uzsakova.." title="Type in a uzsakovas">
    <br><br>
    <div class="lentele1" >
      <table id="myTable">
        <tr>
          <th>Uzsakovas</th>
          <th>Pavadinimas</th>
          <th>Ilgis</th>
          <th>Plotis</th>
          <th>Medziaga</th>
          <th>Klijai</th>
          <th>Eiles</th>
          <th>Spalvos</th>
          <th>Kiekis</th>
          <th>Velenas</th>
          <th>Pabaigimas</th>
          <th>Pastabos</th>
          @if (auth()->user()->permission_lvl>=1000)
          <th>Keisti</th>
          <th>Maketas</th>
          <th>Info</th>
          @endif
        </tr>
        
        @foreach ($orders as $order)

        <tr>
          <form action="{{route('order.store')}}" method="post" enctype="multipart/form-data">
            <td><input type="text" size="10" name="uzsakovas" value="{{$order->uzsakovas}}"></td>
            <td><input type="text" size="10" name="pavadinimas" value="{{$order->pavadinimas}}"></td>
            <td><input type="text" size="2" name="ilgis" value="{{$order->ilgis}}"></td>
            <td><input type="text" size="2" name="plotis" value="{{$order->plotis}}"></td>
            <td><input type="text" size="4" name="medziaga" value="{{$order->medziaga}}"></td>
            <td><input type="text" size="2" name="klijai" value="{{$order->klijai}}"></td>
            <td><input type="text" size="1" name="eiles" value="{{$order->eiles}}"></td>
            <td><input type="text" size="1" name="spalva" value="{{$order->spalva}}"></td>
            <td><input type="text" size="4" name="kiekis" value="{{$order->kiekis}}"></td>
            <td><input type="text" size="4" name="velenas" value="{{$order->velenas}}"></td>
            <td><input type="text" size="6" name="pabaigimas" value="{{$order->pabaigimas}}"></td>
            <input type="hidden" size="4" name="naujoUzsMaketas" value="{{$order->maketas}}">
            <td>
              <textarea name="pastabos" cols="10" rows="1" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>{{$order->pastabos}}
              </textarea>
            </td>
            @if (auth()->user()->permission_lvl>=1000)
            <td>
              <button type="submit">Save</button> 
            </td>
            @csrf
          </form>
          <td>
            <?php if ($order->maketas !== '0') {
              echo '<a style="text-decoration: none" href="'.route('order.printLayout', $order ).'">Maketas</a>';
              //echo '<input type="button" onclick="location.href='.route('order.printLayout', $order ).';" value="Maketas" />';
              } 
              ?>
            {{-- <a href="{{route('order.printLayout', $order )}}"><button>Maketas</button></a> --}}
          </td>
          <td>
            
            <a href="{{route('orderinfo.index', $order )}}"><button>Info</button></a>
          </td>
          @endif
        </tr>
        @endforeach
        
      </table>
    </div>
  </div>
    @endif
    @endif
    @endauth



<script>
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    ;
    for (i = 0; i < tr.length; i++) {
      console.log(tr[i].getElementsByTagName("td")[0])
      if (tr[i].getElementsByTagName("td")[0] === undefined) {
        continue;
      } 
      td = tr[i].getElementsByTagName("input")[0].value;
      if (td) {
        txtValue = td;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
  </script>


</body>
</html>