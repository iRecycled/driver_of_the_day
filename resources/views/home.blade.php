<x-app-layout>
    <div class="container">
        <img src="/images/racing_pic.jpg" class="homePageImg">
        <p class="overlay-text baby-powder" id="cast"> Cast </p>
        <p class="overlay-text indigo-dye" id="your">Your</p>
        <p class="overlay-text fire-engine-red" id="vote">Vote</p>
        <a class="text-white bg-red-500 px-4 bg-white bg-opacity-25 hover:bg-opacity-50" id="home-button" href="/race/create">Find Race</a>

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
</x-app-layout>
