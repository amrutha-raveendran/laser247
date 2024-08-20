<!-- resources/views/components/sidebar.blade.php -->
<div class="col-md-3" style="width: 300px;">
    <h3>Categories</h3>
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

<!-- JavaScript for Collapsible Functionality -->
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

<style>
    /* Optional: Additional styling for the collapsible menu */
    .collapsible {
        cursor: pointer;
        padding: 10px;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        background-color: #f1f1f1;
    }

    .collapsible.active, .collapsible:hover {
        background-color: #ccc;
    }

    .content {
        padding-left: 20px;
        display: none;
        overflow: hidden;
    }

    .content ul {
        list-style-type: none;
        padding-left: 0;
    }

    .content li {
        margin-bottom: 5px;
    }
</style>
