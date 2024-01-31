<x-app-layout>
    <title>dotd results</title>
    <div class="flex justify-center items-center p-6">

        <table>
            <thead>
                @foreach ($drivers->sortByDesc(function ($driver) use ($race){
                    return $driver->getDriverVotes($race->id);
                }) as $driver)
                <tr>
                    <td class="py-4">{{$driver->name}}</td>
                    <td class="ml-20">
                        @if ($race->getTotalVotes() == 0)
                        <a class="py-2 px-4">{{ number_format(0, 2)}}%</a>
                        @endif
                        <a class="py-2 px-4">{{ number_format($driver->getDriverVotes($race->id) / $race->getTotalVotes() * 100, 2) ?? 0 }}%</a>
                    </td>
                </tr>
                @endforeach

            </thead>
        </table>
    </div>
</x-app-layout>
