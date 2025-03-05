@props([
    'id' => null,
    'code' => null,
    'language' => null,
])

<div class="p-2">
    <div class="prose max-w-none lg:prose-xl prose-teal dark:prose-invert max-h-[150px]">
        <pre class="!mt-1">{{ html_entity_decode($code) }}</pre>
    </div>
</div>
