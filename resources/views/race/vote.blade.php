<x-app-layout>
    <title>Create a dotd vote</title>
    <div class="flex justify-center items-center p-6">
        <p> {{ $race->session_id }}</p>
        @livewire('dotd-driver-vote', ['leagueId' => $race->league_id, 'seasonId' => $race->season_id, 'id' => $race->session_id])
    </div>
</x-app-layout>
