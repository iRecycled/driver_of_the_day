<div>
    <div>
        <div>
            <form wire:submit.prevent="searchByLeagueName">
                <input type="text" class="rounded" wire:model="searchQuery" placeholder="Search for a league">
                <button class="bg-blue-500 hover:text-blue-900 font-bold py-2 px-4 rounded text-white" type="submit">Search</button>
            </form>
        </div>
        <div class="flex justify-center items-center pt-2">
            <div wire:loading class="loading-spinner mx-auto my-auto"></div>
        </div>
    </div>

    @if($lastFunctionCalled == "searchByLeagueName")
        @if ($leagueList)
            <ul>
            @foreach($leagueList as $key => $league)
                    <li class="p-2 row-start-2 col-start-1" wire:loading.remove>
                        <a href="#" class="text-blue-600 hover:text-blue-900" wire:click="searchAndShowSeason('{{$key}}')"> {{ $league }}</a>
                    </li>
            @endforeach
            </ul>
        @else
            <ul class="p-2 row-start-2 col-start-1" wire:loading.remove>
                <p> No leagues found </p>
            </ul>
        @endif
    @endif
    @if($lastFunctionCalled == "searchAndShowSeason")
        @if ($seasonList)
        <ul>
            @foreach($seasonList as $key => $season)
                    <li class="p-2 row-start-2 col-start-1" wire:loading.remove>
                        <a  href="#" class="text-blue-600 hover:text-blue-900" wire:click="searchAndShowSession('{{$key}}')"> {{ $season }}</a>
                    </li>
            @endforeach
        </ul>
        @else
        <ul class="p-2 row-start-2 col-start-1" wire:loading.remove>
            <p> No seasons found </p>
        </ul>
    @endif
    @endif
    @if($lastFunctionCalled == "searchAndShowSession")
    @if ($sessionsList)
        <ul>
            @foreach($sessionsList as $key => $session)
                    <li wire:loading.remove class="p-2 row-start-2 col-start-1">
                        <a href="/race/vote/{{$key}}" class="text-blue-600 hover:text-blue-900">{{ $session[0] }}</a>
                        <a class="pl-4"> {{ $session[1] }} </a>
                    </li>
            @endforeach
        </ul>
    @else
        <ul class="p-2 row-start-2 col-start-1" wire:loading.remove>
            <p> No sessions found </p>
        </ul>
    @endif
    @if ($error)
        <ul>
            <li> {{ $error }} </li>
        </ul>
    @endif
@endif
</div>
</div>
