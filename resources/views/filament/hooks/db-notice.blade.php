<div class="bg-amber-100 dark:bg-amber-800 w-full px-3 py-4 my-4 rounded-lg shadow-md hover:shadow-lg duration-200 transition ease-in-out flex items-center justify-start gap-2">
    <x-heroicon-o-exclamation class="w-6 h-6 text-amber-500 dark:text-amber-300" />
    <span>
        FYI:
        {!!
            str()->of('```DB::migrate("fresh")->weekly()->days([0,2,4])->at("4:04");```')
            ->markdown()
        !!}
    </span>
</div>
