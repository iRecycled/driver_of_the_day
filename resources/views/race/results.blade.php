<x-app-layout>
    <title>dotd results</title>
    <div class="flex justify-center items-center p-6">

        <table>
            <thead>
                @foreach ($drivers->sortByDesc(function ($driver) {
                    return $driver->votes()->count();
                }) as $driver)
                <tr>
                    <td class="py-4">{{$driver->name}}</td>
                    <td class="ml-20">
                        {{-- @if ($driver->votes->count() == 0)
                        <a class="py-2 px-4">{{ number_format(0,2) }}%</a>
                        @else --}}
                        <a class="py-2 px-4">{{ number_format($driver->votes->count() / $totalVotes * 100, 2) ?? 0 }}%</a>
                        {{-- @endif --}}
                    </td>
                </tr>
                @endforeach

            </thead>
        </table>
    </div>
</x-app-layout>
