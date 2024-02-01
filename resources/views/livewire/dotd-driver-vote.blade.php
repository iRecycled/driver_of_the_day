<div>
    <table>
        <thead>

            @foreach ($drivers as $driver)
            <tr>
                <td class="py-4">{{$driver->display_name}}</td>
                <td class="ml-20">
                    @if ($race->getTimeLeftToVote() != null)
                        <button class="bg-blue-500 hover:text-blue-900 font-bold py-2 px-4 rounded text-white"
                        wire:click="castVote({{json_encode($driver)}})">Vote</button>
                    @else
                        <button class="bg-gray-400 cursor-not-allowed opacity-70 py-2 px-4 rounded" disabled>Vote</button>
                    @endif
                </td>
            </tr>
            @endforeach

        </thead>
    </table>
</div>
