<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <style>
  .container{
    display: grid;
    grid-template-columns: 20px 1fr 5fr 1fr 20px;
    grid-template-rows: auto;
    grid-template-areas:     
    ". . store .  ."
    ". . alert. ."
    ". ats_uzs ats_uzs ats_uzs ."
    ". lentele1 lentele1 lentele1 ."
    ". h2 h2 h2 ."
    ". filtras filtras filtras ."
    ". lentele lentele lentele ."
    ". vyniokles vyniokles vyniokles ."
    ". lentele2 lentele2 lentele2 ."
    ". lentele3 lentele3 lentele3 .";
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
  .lentele2{
    grid-area: lentele2;
    overflow-x:auto;
  }
  .lentele3{
    grid-area: lentele3;
    overflow-x:auto;
  }
  h2{
    padding: 20px 0px;
    grid-area: h2;
    text-align: center;
  }
  .vyniokles{
    grid-area: vyniokles;
    text-align: center;
  }
  .ats_uzs{
    grid-area: ats_uzs;
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
    height: 30px;
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

  .list-group{

  }


  </style>
  <title>Masinos</title>
</head>
<body>
  @auth
  @if (auth()->user()->status!=0 )
  
  @include('header')

  <div class="container">
    @include('errors')

    
    @if (auth()->user()->permission_lvl>=2000 )
    @include('machine.storeMachine')
    @endif  
    
    @if(auth()->user()->permission_lvl>=100 )
    <h2 class="ats_uzs">Atspausdinti uzsakymai</h2>
    @include('machine.printedOrders')
    @endif
    
    
        
    @if(auth()->user()->permission_lvl>=100 )
    <h1 class="vyniokles">Vyniokles</h1>
    @include('machine.rewinders')
    @endif


    @if(auth()->user()->permission_lvl>=500 )
    <h2>Spausdinimo masinos</h2>
    @include('machine.printMachines')          
    @endif

  </div>
  @endif
  @endauth
</body>
</html>