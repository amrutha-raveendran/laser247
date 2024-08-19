<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered Events</title>
</head>
<body>
    <h1>Filtered Events</h1>
    @if($events->isEmpty())
        <p>No events found.</p>
    @else
        <ul>
            @foreach ($events as $event)
                <li>
                    <strong>{{ $event['name'] }}</strong><br>
                    Competition: {{ $event['competition_name'] }}<br>
                    Open Date: {{ $event['open_date'] }}
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
