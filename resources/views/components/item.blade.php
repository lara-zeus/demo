
<div class="hover:scale-105 bg-white/80 dark:bg-gray-800 px-4 py-4
    hover:border-primary-200 border border-secondary-200 dark:border-gray-700
    shadow-lg dark:hover:shadow-lg dark:hover:shadow-gray-800
    rounded-[2rem] rounded-bl-none rounded-tr-none transition ease-in-out duration-300
    flex flex-col gap-2 items-center sm:items-start">
    <div class="text-3xl title-font">
        <span class="flex sm:flex-none gap-2 justify-center sm:justify-start">
            {{ $title }}
        </span>
    </div>
    <p class="my-2 text-gray-700 dark:text-gray-100 text-xl h-full">
        {{ $desc }}
    </p>
    <div class="mt-2 flex gap-2 sm:justify-center lg:justify-end w-full">
        {{ $btns }}
    </div>
</div>
