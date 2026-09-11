<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        a {
            text-decoration: none;
        }
        th {
            height: 30px;
            text-align: center;
        }
        td {
            height: 100px;
            vertical-align: top;
        }
        td a {
            color: black;
        }
        .today {
            background: orange !important;
        }
        th:nth-of-type(1), td:nth-of-type(1) a.day-number {
            color: red;
        }
        th:nth-of-type(7), td:nth-of-type(7) a.day-number {
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h3 class="nb-4">
            <a href="{{ route('index', ['ym' => $prev]) }}">&lt;</a>
            <span class="mx-3">{{ $html_title }}</span>
            <a href="{{ route('index', ['ym' => $next]) }}">&gt;</a>
        </h3>
        <table class="table table-bordered">
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
            @foreach($weeks as $week)
                {!! $week !!}
            @endforeach
        </table>
    </div>
</body>
</html>