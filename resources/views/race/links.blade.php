<x-app-layout>
    <title>Create a dotd vote</title>
    <div class="flex justify-center items-center p-6">
        <input type="text" id="urlText" value="{{ $url }}" class="m-10 hidden"/>
        <button onclick="copyQRUrlText()" class="m-10 text-blue-500 hover:text-blue-800">Copy QR url</button>
        <br>
        <img src="{{ $qr }}" alt="QR Code" width="100" height="100" class="m-10">
        <a href="/race/vote/{{$id}}" class="p-2 bg-blue-500 rounded text-white">Go Vote</a>
    </div>

    <script>
        function copyQRUrlText() {
            let copyText = document.querySelector("#urlText");
            copyText.select();
            copyText.setSelectionRange(0,9999);
            navigator.clipboard.writeText(copyText.value);
        }
    </script>
</x-app-layout>
