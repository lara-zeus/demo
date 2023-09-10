<div class="flex flex-col gap-2 items-center sm:items-start w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
    <div class="text-3xl lg:text-4xl title-font">
        <span class="flex sm:flex-none mt-4 justify-center sm:justify-start">
            {{ $title }}
        </span>
    </div>
    <p class="my-4 text-gray-700 dark:text-gray-100 text-xl h-full">
        {{ $desc }}
    </p>
    <div class="flex gap-4 sm:justify-center lg:justify-end w-full">
        {{ $btns }}
    </div>
</div>
