<div class="bg-amber-100 dark:bg-gray-800 w-full px-3 py-4 my-4 rounded-lg
            shadow-md hover:shadow-lg duration-200 transition ease-in-out flex items-start
            justify-start gap-2">
    @svg('heroicon-o-exclamation-triangle','w-6 h-6 text-amber-500 dark:text-amber-300')
    <div class="w-full">
        <span class="font-semibold">BTW:</span>
        <pre><x-torchlight-code language='php'>
        DB::migrate("fresh")->weekly()->days([0,2,4])->at("4:04")
        </x-torchlight-code></pre>
    </div>
</div>
