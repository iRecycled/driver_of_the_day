{{-- @vite(['resources/css/dotd.css', 'resources/js/app.js']); --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
<html>
    {{-- <div class="dotd-example">
        <div class="dotd-title">
        VOTE FOR DRIVER OF THE DAY
        </div>
        <div class="driver-rows">

            @foreach ($drivers as $key => $driver)
                <div class="driver">
                    <p>#{{$loop->index + 1}}</p>
                    <p>{{$driver->name}}</p>
                    <p>{{ $driver->getDriverVotes($race->id) / $totalVotes * 100 ?? 0 }}%</p>
                    <div class="percentage-bar" style="width: {{ $driver->getDriverVotes($race->id) / $totalVotes * 100 }}%"></div>
                </div>
            @endforeach
        </div>
    </div> --}}

    <div wire:poll.750ms>

        Current time: {{ now() }}

    </div>
    <div class="flex flex-col">
        <div class="flex bg-black-500 justify-center">
            <h1>VOTE FOR DRIVER OF THE DAY</h1>
        </div>
        @foreach ($drivers as $key => $driver)
        <div class="relative py-2">
            <span class="absolute top-0 left-0 text-white pr-2 flex justify-between w-full py-2">
                <p class="flex flex-row justify-start">#{{$loop->index + 1}}</p>
                <p class="flex flex-row justify-center">{{$driver->name}}</p>
                @if ($totalVotes == 0)
                    <p class="flex flex-row justify-end">0%</p>
                    </span>
                    <progress class="w-full h-6 bg-red-500" value="0" max="100"></progress>
                @else
                    <p class="flex flex-row justify-end">{{ $driver->getDriverVotes($race->id) / $totalVotes * 100 }}%</p>
                    </span>
                    <progress class="w-full h-6 bg-red-500" value={{ $driver->getDriverVotes($race->id) / $totalVotes * 100 }} max="100"></progress>
                @endif
        </div>
        @endforeach

    </div>
    </div>
</html>

