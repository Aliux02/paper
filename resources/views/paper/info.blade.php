<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <title>Popieriaus info</title>
</head>
<body>
  @include('header')
  @auth
  @if (auth()->user()->status!=0 )
  @if (auth()->user()->permission_lvl>=1000)

  <div class="container">
    <div class="firstTable">
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