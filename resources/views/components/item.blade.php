<div class="px-4 py-4 border border-secondary-200 dark:border-gray-700
    bg-gradient-to-br from-white dark:from-gray-900 to-gray-50 dark:to-gray-800
    shadow-lg hover:shadow-xl dark:hover:shadow-lg dark:hover:shadow-gray-800
    rounded-2xl transition ease-in-out duration-300
    flex flex-col gap-2 items-center sm:items-start">
    <div class="text-5xl lg:text-6xl title-font">
        <span class="flex sm:flex-none mt-4 sm:mt-8 justify-center sm:justify-start">
            {{ $title }}
        </span>
    </div>
    <p class="my-10 text-gray-700 dark:text-gray-100 text-xl h-full">
        {{ $desc }}
    </p>
    <div class="mt-5 flex gap-4 sm:justify-center lg:justify-end w-full">
        {{ $btns }}
    </div>
</div>
