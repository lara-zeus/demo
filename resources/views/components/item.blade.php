
<div class="px-4 py-4 bg-gradient-to-br from-white to-gray-50 shadow-lg rounded-3xl hover:shadow-xl transition ease-in-out duration-300 flex flex-col gap-2 items-center sm:items-start">
    <div class="text-5xl lg:text-6xl font-extrabold">
        <span class="flex sm:flex-none mt-4 sm:mt-8 justify-center sm:justify-start">
            {{ $title }}
        </span>
    </div>
    <p class="my-10 text-gray-700 text-xl h-full">
        {{ $desc }}
    </p>
    <div class="mt-5 sm:flex sm:justify-center lg:justify-end w-full">
        {{ $btns }}
    </div>
</div>
