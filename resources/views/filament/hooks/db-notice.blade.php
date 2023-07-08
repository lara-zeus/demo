<link rel="stylesheet" href="https://highlightjs.org/static/demo/styles/base16/tomorrow.css">
<style>
    pre code.hljs {
        padding: .55rem .75rem !important;
        background: #F4F5F5 !important;
        border-radius: .5rem;
        border: solid lightgray 1px;
    }
</style>
<script src="https://unpkg.com/@highlightjs/cdn-assets@11.7.0/highlight.min.js"></script>
<script src="https://unpkg.com/@highlightjs/cdn-assets@11.7.0/languages/php.min.js"></script>
<script>hljs.highlightAll({style: 'github'});</script>

<div class="bg-amber-100 dark:bg-amber-800 w-full px-3 py-4 my-4 rounded-lg shadow-md hover:shadow-lg duration-200 transition ease-in-out flex items-center justify-start gap-2">
    <x-heroicon-o-exclamation class="w-6 h-6 text-amber-500 dark:text-amber-300" />
    <span>
        <span class="font-semibold">FYI:</span>
        {!!
str()->of('
```php
DB::migrate("fresh")->weekly()->days([0,2,4])->at("4:04")
```
')
            ->markdown()
        !!}
    </span>
</div>
