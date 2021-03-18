<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>Vartotojai</title>

</head>
<body>
  @include('header')
  <div class="container">
@auth
@if (auth()->user()->status!=0 )
@if (auth()->user()->permission_lvl>=2000 )

    

  
  <div class="filter">
    <div class="permissionLvl">
      <h2 class="titleOne" >Vartotoju leidimo reziai</h2>
      <dl>
        <li>Pagalbiniai nuo 10 iki 100</li>
        <li>Vyniotojai nuo 100 iki 500</li>
        <li>Spaudejai nuo 500 iki 750</li>
        <li>Pakuotojai nuo 750 iki 1000</li>
        <li>Vadovai, vadyba nuo 1000 iki 2000</li>
      </dl> 
    </div>
    <div class="storeMachine">
      <h2 class="titleOne" >Ivesti nauja irengini</h2>
      
        <form action="{{route('machine.store')}}" method="post">
          <label for="pavadinimas">Pavadinimas:</label>
          <input type="text" id="pavadinimas" size="8" name="pavadinimas" value="">
      <br><br>
          <label for="tipas">Tipas:</label>
          <select id="tipas" name="tipas" >
            <option value="vyniokle">Vyniokle</option>
            <option value="spausdinimo">Spausdinimo</option>
          </select>
        
      <br><br>

          <div class="btn_store">
            <input  type="submit" value="Submit">
            @csrf
          </div>
        </form>
      
    </div> 
  </div>
<div class="firstTable">
  <div class="header">Vartotojai</div>
  <table>
    <thead>
    <tr>
        <th>Vardas</th>
        <th>El. pastas</th>
        <th>Patvirtinimas</th>
        <th>Leidimo lygis</th>
        <th>Patvirtinti</th>
    </tr>
  </thead>
  <tbody>
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
  </tbody>


  </table>
</div>
@endif
@endif
@endauth
</div>
</body>
</html>