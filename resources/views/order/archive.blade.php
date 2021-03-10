<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <title>Archyvas</title>
</head>
<body>

  @auth
  @if (auth()->user()->status!=0 )
  @if (auth()->user()->permission_lvl>=750)
  @include('header')
    <div class="container">
    <br>
    <input type="text" id="myInput" onkeyup="myFunction()" style="margin-top:20px" placeholder="Iveskite uzsakova.." title="Paieska">
    <br><br>
    <div class="secondTable" >
      <div class="header">Archyvas</div>
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