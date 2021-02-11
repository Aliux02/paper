<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>Vartotojai</title>
    <style>
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
@if (auth()->user()->permission_lvl>=2000 )

    

    <h2>Vartotoju leidimo reziai</h2>

<ul>
  <li>Pagalbiniai nuo 10 iki 100</li>
  <li>Vyniotojai nuo 100 iki 500</li>
  <li>Spaudejai nuo 500 iki 750</li>
  <li>Pakuotojai nuo 750 iki 1000</li>
  <li>Vadovai, vadyba nuo 1000 iki 2000</li>
</ul>  

<table>
    <tr>
        <th>Vardas</th>
        <th>El. pastas</th>
        <th>Patvirtinimas</th>
        <th>Leidimo lygis</th>
        <th>Patvirtinti</th>
    </tr>
    @foreach ($users as $user)
    <tr>
    <form action="{{route('user.update', $user)}}" method="post">
        <td><input type="text" size="10" name="name" value="{{$user->name}}"></td>
        <td><input type="text" size="16" name="email" value="{{$user->email}}"></td>
        <td><input type="text" size="10" name="status" value="{{$user->status}}"></td>
        <td><input type="text" size="10" name="permission_lvl" value="{{$user->permission_lvl}}"></td>
        <td><button type="submit">Patvirtinti</button></td>
    @csrf
    </form>
    </tr>
      @endforeach



</table>
@endif
@endif
@endauth
</body>
</html>