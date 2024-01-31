<x-app-layout>
    <title>Cast your Vote</title>
    <div class="m-10">
        <a class="bg-blue-500 text-white hover:text-blue-900 p-2 rounded" href="/race/links/{{$id}}">Streamer Links</a>
        <a class="bg-blue-500 text-white hover:text-blue-900 p-2 ml-6 rounded" href="/race/{{$id}}/results">View Results</a>
    </div>
    <div class="flex justify-center items-center p-6">
        @livewire('dotd-driver-vote', ['leagueId' => $leagueId, 'seasonId' => $seasonId, 'id' => $id])
    </div>
</x-app-layout>
