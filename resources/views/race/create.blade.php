<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create a dotd vote</title>

        </head>
    <body>
        @livewireScripts
        @livewireStyles
        <div class="flex justify-center items-center p-6">
            @livewire('iracing-api-search')
        </div>
        <div>
            <p> all the drivers: <span> {{ $drivers }} </span></p>
        </div>
    </body>
    </html>
</x-app-layout>
