<x-app-layout>
    <title>Cast your Vote</title>
    <div class="m-10">
        <div class="flex items-center">
            <a class="bg-blue-500 text-white hover:text-blue-900 p-2 rounded" href="/race/links/{{$race->session_id}}">Streamer Links</a>
            <a class="bg-blue-500 text-white hover:text-blue-900 p-2 ml-6 rounded" href="/race/{{$race->session_id}}/results">View Results</a>
        </div>
        <div class="flex items-center">

        <div id="countdownExample">
            <div class="values"></div>
        </div>
        @if ($race->getTimeLeftToVote() == null)
        <p class="p-2 mx-auto"> Time left to vote: Voting Ended</p>
        @else
            <p class="p-2 mx-auto"> Time left to vote: <span id="countdown"></span></p>
        @endif
        </div>
    </div>
    <div class="flex justify-center items-center p-6">
        @livewire('dotd-driver-vote', ['race' => $race])
    </div>

    <script>

        const totalSecondsLeft = "{{$race->getTimeLeftToVote()}}";
        function startTimer(duration, display) {
        var timer = duration, minutes, seconds;

            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
        }
        window.onload = function() {
            startTimer(totalSecondsLeft, document.querySelector("#countdown"));
        }

    </script>
</x-app-layout>
