<div class="w-full px-3 py-4 my-4 rounded-lg

            dark:bg-gradient-to-tl dark:from-gray-800 dark:to-gray-900 dark:via-gray-900
            bg-gradient-to-bl from-amber-200 to-amber-100 via-amber-100

            shadow-md hover:shadow-lg duration-200 transition ease-in-out
            flex items-center justify-center gap-2">
    @svg('heroicon-o-exclamation-triangle','w-10 h-10 text-amber-500 dark:text-amber-500')

    <div class="w-full">
        <pre><x-torchlight-code language='php'>
        DB::migrate("fresh")->weekly()->days([0,2,4])->at("4:04")
        </x-torchlight-code></pre>
    </div>
</div>
