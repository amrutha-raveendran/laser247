<aside class="menu">
    
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
</aside>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const coll = document.querySelectorAll('.collapsible');
        coll.forEach(function (button) {
            button.addEventListener('click', function () {
                this.classList.toggle('active');
                const content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        });
    });
</script>