<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <style>
        .collapsible {
            cursor: pointer;
            padding: 10px;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
        }

        .active, .collapsible:hover {
            background-color: #ccc;
        }

        .content {
            padding-left: 20px;
            display: none;
            overflow: hidden;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const coll = document.getElementsByClassName("collapsible");
            for (let i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function () {
                    this.classList.toggle("active");
                    const content = this.nextElementSibling;
                    if (content.style.display === "block") {
                        content.style.display = "none";
                    } else {
                        content.style.display = "block";
                    }
                });
            }
        });
    </script>
</head>
<body>
    <div style="display: flex;">
        <!-- Sidebar -->
        <div style="width: 20%; padding: 10px;">
            <h3>Categories</h3>
            <ul>
                @foreach ($menu as $item)
                    @if ($groupedEvents->has($item['id']))
                        <li>
                            <button class="collapsible">{{ $item['name'] }}</button>
                            <div class="content">
                                @foreach ($groupedEvents[$item['id']] as $competitionName => $events)
                                    <button class="collapsible">{{ $competitionName }}</button>
                                    <div class="content">
                                        <ul>
                                            @foreach ($events as $event)
                                                <li>
                                                    <a href="{{ route('event.details', ['eventId' => $event['event_id']]) }}">
                                                        {{ $event['name'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Events Content (optional, if you want to display events in a separate section) -->
        <div style="width: 80%; padding: 10px;">
            <h3>Events</h3>
            <!-- You can add content here if needed -->
        </div>
    </div>
</body>
</html>
