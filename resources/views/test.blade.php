<aside class="menu">
    
    <ul>
        {{dd($groupedEvents)}}
        @foreach ($menu as $item)
            @if($groupedEvents->has($item['id']))
                <li><a href="#" class="menu-link">{{ $item['name'] }}</a></li>
                
              @foreach ($groupedEvents[$item['id']] as $competitionName => $events)
              <li><a href="#" class="menu-link">{{$competitionName}} </a></li>
                @if(!$events->isempty())
                    

                @endif
              @endforeach
                
                    
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