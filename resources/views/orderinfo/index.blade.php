<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Uzsakymo istorija</title>
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
  <header>
      <a href="{{route('welcome')}}"><button>Atgal</button></a>
  </header>
  <h2 class="lia">Uzsakymo istorija</h2>
  <div class="container">
    <div class="lentele1" >
      <table>
        <tr>
          <th>Uzpilde</th>
          <th>Uzpildyta</th>
          <th>Atspausdino</th>
          <th>Atspausdinta</th>
          <th>Suvyniojo</th>
          <th>Suvyniota</th>
          <th>Supakavo</th>
          <th>Supakuota</th>
          
          
        </tr>
          
        @foreach ($orderinfos as $orderinfo)

        <tr>
          <form action="" method="post">
            <td><input type="text" size="8" name="uzpilde" value="{{$orderinfo->uzpilde}}"></td>
            <td><input type="text" size="14" name="uzpildyta" value="{{$orderinfo->uzpildyta}}"></td>
            <td><input type="text" size="8" name="atspausdino" value="{{$orderinfo->atspausdino}}"></td>
            <td><input type="text" size="14" name="atspausdinta" value="{{$orderinfo->atspausdinta}}"></td>
            <td><input type="text" size="8" name="suvyniojo" value="{{$orderinfo->suvyniojo}}"></td>
            <td><input type="text" size="14" name="suvyniota" value="{{$orderinfo->suvyniota}}"></td>
            <td><input type="text" size="8" name="supakavo" value="{{$orderinfo->supakavo}}"></td>
            <td><input type="text" size="14" name="supakuota" value="{{$orderinfo->supakuota}}"></td>
            



        </tr>
        @endforeach
          
      </table>
    </div>
  </div>
</body>
</html>