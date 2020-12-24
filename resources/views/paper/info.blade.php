<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popieriaus info</title>
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

    <table>
        <tr>
            <th>Kiekis</th>
            <th>Nurasyta</th>
        </tr>
      
        @foreach ($infos as $info)
        <tr>
            <td>{{$info->kiekis}}</td>
            <td>{{$info->modifikuota}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>