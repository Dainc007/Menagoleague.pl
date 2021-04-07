@if(!empty(auth()->user()->team->players))

@foreach(auth()->user()->team->players as $player)
<p> <a href="{{route('players.show', [ 'player' => $player ])}}">
        {{$player->name}}
        {{$player->position}}
        {{$player->overall}}
    </a>
</p>

@endforeach

@else
<p>W Twojej druzynie nie ma obecnie zadnego piłkarza</p>

@endif