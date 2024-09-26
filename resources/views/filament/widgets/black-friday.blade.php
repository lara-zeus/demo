<x-filament-widgets::widget id="black-friday-widget">
    <div id="timer" class="font-covered flex gap-4 sm:gap-10 items-end justify-center">
        <div class="flex flex-col gap-0 text-[#db4844] sm:text-[200px] text-[100px] tracking-wider place-items-start leading-none" id="days">
            <span class='text-primary-600 text-lg sm:text-2xl'>Days</span><span class=''>00</span>
        </div>
        <div class="flex flex-col gap-0 text-[#f07c22] sm:text-[150px] text-[75px] tracking-wider place-items-start leading-none" id="hours">
            <span class='text-primary-600 text-lg sm:text-2xl'>Hours</span><span class=''>00</span>
        </div>
        <div class="flex flex-col gap-0 text-[#f6da74] sm:text-[100px] text-[50px] tracking-wider place-items-start leading-none" id="minutes">
            <span class='text-primary-600 text-lg sm:text-2xl'>Minutes</span><span class=''>00</span>
        </div>
        <div class="flex flex-col gap-0 text-[#abcd58] sm:text-[50px] text-[25px] tracking-wider place-items-start leading-none" id="seconds">
            <span class='text-primary-600 text-lg sm:text-2xl'>Seconds</span><span class=''>00</span>
        </div>
    </div>
    <p class="font-covered text-center text-2xl tracking-wider leading-loose sm:text-3xl text-gray-600 dark:text-gray-300">wait for it!</p>
    <p class="text-center !text-sm tracking-wider leading-loose sm:text-xl text-gray-600 dark:text-gray-300">
            <a href="https://larazeus.com#mail-list">
                be the first to know, join our mailing list
            </a>
        </p>

    <style>
        @import url(https://fonts.googleapis.com/css?family=Covered+By+Your+Grace);

        .font-covered {
            font-family: 'Covered By Your Grace', cursive;
        }
    </style>
</x-filament-widgets::widget>
