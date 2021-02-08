<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popieriaus info</title>
    <style>
        .container{
          display: grid;
          grid-template-columns: 20px 1fr 5fr 1fr 20px;
          grid-template-rows: auto;
          grid-template-areas:     
          ". . store .  ."
          ". h2 h2 h2 ."
          ". filtras filtras filtras ."
          ". . lentele . .";
        }
        .lentele{
          grid-area: lentele;
          overflow-x:auto;
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
    </style>
</head>
<body>

  @auth
  @if (auth()->user()->status!=0 )
  @if (auth()->user()->permission_lvl>=1000)

  <div class="container">
  <div class="lentele">
    <table>
        <tr>
            <th>Kiekis</th>
            <th>Nurasyta</th>
            <th>Nurase</th>
        </tr>
      
        @foreach ($infos as $info)
        <tr>
            <td>{{$info->kiekis}}</td>
            <td>{{$info->modifikuota}}</td>
            <td>{{$info->user_name}}</td>
        </tr>
        @endforeach
    </table>
  </div>
</div>

@endif
@endif
@endauth
</body>
</html>