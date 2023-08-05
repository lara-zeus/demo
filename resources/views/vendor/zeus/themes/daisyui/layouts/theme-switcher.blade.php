<li title="Change Theme" class="dropdown">
    <details>
        <summary>
            @svg('bi-brush','h-5 w-5')
        </summary>
        <ul class="z-50 dropdown-content bg-base-200 text-base-content rounded-box h-[70vh] max-h-96 w-56 overflow-y-auto shadow">
            <div class="grid grid-cols-1 gap-3 p-3" tabindex="0">
                @foreach(array_keys(config('zeus.themes')) as $theme)
                    <a href="{{ url('theme/'.$theme) }}" class="outline-base-content overflow-hidden rounded-lg text-left">
                        <div class="bg-base-100 text-base-content w-full cursor-pointer font-sans">
                            <div class="grid grid-cols-5 grid-rows-3">
                                <div class="col-span-5 row-span-3 row-start-1 flex items-center gap-2 px-4 py-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                         fill="currentColor" class="invisible h-3 w-3 shrink-0">
                                        <path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"></path>
                                    </svg>
                                    <div class="flex-grow text-sm">{{ str($theme)->title() }}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </ul>
    </details>
</li>


