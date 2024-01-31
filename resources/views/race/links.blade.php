<x-app-layout>
    <title>Create a dotd vote</title>
    <div class="flex flex-col p-6">
        <div class="flex justify-center">
            <a href="/race/vote/{{$id}}" class="p-2 bg-blue-500 rounded text-white">Go Vote</a>
            <a href="/race/{{$id}}/results" class="p-2 ml-10 bg-blue-500 rounded text-white">View Results</a>
        </div>
        <div class="flex justify-center items-center p-6">
            <input type="text" id="urlText" value="{{ $url }}" class="m-10 hidden"/>
            <button onclick="copyUrl('urlText')" class="m-10 text-blue-500 hover:text-blue-800">Copy QR url</button>
            <a href="/race/qr/{{$id}}">
                <img src="{{ $qr }}" alt="QR Code" width="100" height="100" class="m-10">
            </a>
        </div>
        <div class="flex justify-center item-centers p-6">
            <input type="text" id="dotdUrl" value="{{ $dotdUrl }}" class="m-10 hidden"/>
            <button onclick="copyUrl('dotdUrl')" class="m-10 text-blue-500 hover:text-blue-800">Copy dotd page url</button>
            <a href="/race/dotd/{{$id}}">
                <img src="/images/dotd-example.png" alt="driver of the day results" width="100" height="100" class="m-10">
            </a>
        </div>
    </div>
    <div class="flex justify-center items-center p-6">

    </div>

    <script>
        function copyUrl(elementId) {
            let copyText = document.querySelector(`#${elementId}`);
            copyText.select();
            copyText.setSelectionRange(0,9999);
            navigator.clipboard.writeText(copyText.value);
        }
    </script>
</x-app-layout>
