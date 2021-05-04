@if(!empty(auth()->user()->team->players))

@foreach(auth()->user()->team->players as $player)
<p> <a href="{{route('players.show', [ 'player' => $player ])}}">
        {{$player->name}}
        {{$player->position}}
        {{$player->overall}}
        {{$player->pivot->wage}}
        {{$player->pivot->player_role}}
        {{$player->pivot->contract_sign_at}}
        {{$player->pivot->contract_expires}}
    </a>
</p>
@endforeach

@else
<p>W Twojej druzynie nie ma obecnie zadnego piłkarza</p>

@endif