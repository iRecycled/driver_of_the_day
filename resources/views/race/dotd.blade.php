@vite(['resources/css/dotd.css', 'resources/js/app.js'])
<html>
    <div class="dotd-example">
        <div class="dotd-title">
        VOTE FOR DRIVER OF THE DAY
        </div>
        <div class="driver-rows">

            @foreach ($drivers as $key => $driver)
                <div class="driver">
                    <p>#{{$loop->index + 1}}</p>
                    <p>{{$driver->name}}</p>
                    <p>{{ $driver->votes->count() / $totalVotes->count() * 100 ?? 0 }}%</p>
                    <div class="percentage-bar" style="width: {{ $driver->votes->count() / $totalVotes->count() * 100 }}%"></div>
                </div>
            @endforeach
        </div>
    </div>
</html>

