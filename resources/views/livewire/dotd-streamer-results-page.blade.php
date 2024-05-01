<div>
    <div class="flex flex-col">
        <div wire:poll.3000ms></div>
        <div class="flex bg-black-500 justify-center">
            <h1>VOTE FOR DRIVER OF THE DAY</h1>
        </div>
        @foreach ($drivers as $key => $driver)
        <div class="relative py-2">
            <span class="absolute top-0 left-0 text-white pr-2 flex justify-between w-full py-2">
                <p class="flex flex-row justify-start text-black">#{{$loop->index + 1}}</p>
                <p class="flex flex-row justify-center text-black">{{$driver->name}}</p>
                @php
                    $percentageVotes = ($totalVotes != 0) ? ($driver->getDriverVotes($race->id) / $totalVotes * 100) : 0;
                @endphp
                @if ($totalVotes == 0)
                    <p class="flex flex-row justify-end text-black">0%</p>
                    </span>
                    <progress class="w-full h-6 text-black" value="0" max="100"></progress>
                @else
                    <p class="flex flex-row justify-end text-black">{{ $percentageVotes }}%</p>
                    </span>
                    <progress class="w-full h-6 text-black" value={{ $percentageVotes }} max="100"></progress>
                @endif
        </div>
        @endforeach
    </div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</div>
