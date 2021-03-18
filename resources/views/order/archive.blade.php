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
    

    
    <div class="secondTable" >
      <input type="text" id="myInput" onkeyup="myFunction()" 
      style="margin-top:50px" placeholder="Iveskite uzsakova.." title="Paieska">
      <div class="header">Archyvas</div>
      <table id="myTable">
        <thead>
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
          {{-- <th>Keisti</th> --}}
          {{-- <th>Maketas</th> --}}
          <th>Info</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)

        <tr onclick="window.location='{{route('order.storeFromArchive',$order)}}'">
          <form action="{{route('order.storeFromArchive',$order)}}" method="get" enctype="multipart/form-data">
            <td>{{$order->uzsakovas}}</td>
            <td>{{$order->pavadinimas}}</td>
            <td>{{$order->ilgis}}</td>
            <td>{{$order->plotis}}</td>
            <td>{{$order->medziaga}}</td>
            <td>{{$order->klijai}}</td>
            <td>{{$order->eiles}}</td>
            <td>{{$order->spalva}}</td>
            <td>{{$order->kiekis}}</td>
            <td>{{$order->velenas}}</td>
            <td>{{$order->pabaigimas}}</td>
            <input type="hidden" size="4" name="naujoUzsMaketas" value="{{$order->maketas}}">
            <td>{{$order->pastabos}}</td>
            @if (auth()->user()->permission_lvl>=1000)
            {{-- <td>
              <button type="submit">Save</button> 
            </td> --}}
            @csrf
          </form>
          {{-- <td>
            @if ($order->maketas !== '0')
              <a style="text-decoration: none" href="'.route('order.printLayout', $order ).'">Maketas</a>
            @endif
          </td> --}}
          <td>
            <a href="{{route('orderinfo.index', $order )}}"><button>Info</button></a>
          </td>
          @endif
        </tr>
        @endforeach
      </tbody>
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