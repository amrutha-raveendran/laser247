<!-- resources/views/components/sidebar.blade.php -->

    <div class="sidebar-menu">
        <ul>
            @foreach ($menuData as $item)
                @if ($sidebarEvents->has($item['id']))
                    <li>
                        <button class="collapsible">{{ $item['name'] }}</button>
                        <div class="content">
                            @foreach ($sidebarEvents->get($item['id']) as $competitionName => $events)
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
