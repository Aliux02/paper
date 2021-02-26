<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
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
          ". lia lia lia ."
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
          display: grid;
          grid-template-columns:  1fr 3fr 1fr;
          grid-template-rows: auto;
          grid-template-areas:     
          ". ivestis1 ."
          ;
          /* display: flex;
          justify-content: center;
          align-items: center; */
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
          padding: 20px 0;
        }
        .lia{
          grid-area: lia;
          text-align: center;
          padding: 20px;
        }
        .ivestis{
          
          /* width: 200px; */
          height: 38px;
          padding: 0px 20px;
          float: left;
        }
        .ivestis1{
          border-style: solid;
          background-color: rgb(226, 235, 228);
          /* width: 200px; */
          grid-area: ivestis1;
        }


        .btn_ivastis{
          float: right;
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
        input::-webkit-datetime-edit{ color: #000; }
        input:focus::-webkit-datetime-edit{ color: #000; }
        /* input::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
          } */
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
    <title>Uzsakymai</title>
</head>
<body>

  @auth
  @if (auth()->user()->status!=0 )
  
  @include('header')
  @include('errors')

  @if (auth()->user()->permission_lvl>=1000)
  <a href="{{route('order.create')}}" style="margin-left: 20px; text-decoration:none">Ivesti uzsakyma</a>
  @endif

  <div class="container">


    
    @if (auth()->user()->permission_lvl>=750)
     <h2>Einamuju uzsakymu sarasas</h2>
    @include('order.allOrders')
    @endif

    @if (auth()->user()->permission_lvl>=1000)
      <h2 class="lia">Supakuotu uzsakymu sarasas</h2>
      @include('order.packedOrders')
    @endif
  </div>
  
  @endif
  @endauth

</body>
</html>