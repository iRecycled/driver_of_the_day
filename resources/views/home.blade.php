<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Livewire Styles/Scripts -->
    @livewireStyles
    @livewireScripts

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('dotd-template.css') }}">
</head>
<body>

    <div class="container">
        <img src="{{ asset('racing_pic.jpg') }}" class="homePageImg">
        <p class="overlay-text baby-powder" id="cast"> Cast </p>
        <p class="overlay-text indigo-dye" id="your">Your</p>
        <p class="overlay-text fire-engine-red" id="vote">Vote</p>

        <div class="dotd-example">
            <div class="dotd-title">
            VOTE FOR DRIVER OF THE DAY
            </div>
                <div class="driver-rows">
                    <div class="driver">
                        <p>1st.</p>
                        <p>Nick Peterson</p>
                        <p>50%</p>
                        <div class="percentage-bar" style="width: 50%"></div>
                    </div>
                    <div class="driver">
                        <p>2nd.</p>
                        <p>Raymond Aguilar</p>
                        <p>34%</p>
                        <div class="percentage-bar" style="width: 34%"></div>
                    </div>
                    <div class="driver">
                        <p>3rd.</p>
                        <p>Antonio Bianchi</p>
                        <p>16%</p>
                        <div class="percentage-bar" style="width: 16%"></div>
                    </div>

                </div>
        </div>
    </div>
</body>
</html>
</x-app-layout>
