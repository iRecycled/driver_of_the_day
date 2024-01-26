<x-app-layout>
    <title>Create a dotd vote</title>
    <div class="flex justify-center items-center p-6">
        <p> {{ $id }}</p>

        <table>
            <thead>

                @foreach ($drivers->sortByDesc(function ($driver) {
                    return $driver->votes->count();
                }) as $driver)
                <tr>
                    <td class="py-4">{{$driver->name}}</td>
                    <td class="ml-20">
                        <a class="py-2 px-4">{{ number_format($driver->votes->count() / $totalVotes * 100, 2) ?? 0 }}%</a>
                    </td>
                </tr>
                @endforeach

            </thead>
        </table>
    </div>
</x-app-layout>
