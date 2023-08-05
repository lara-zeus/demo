<li title="Change Language" class="dropdown">
    <details>
        <summary>
            @svg('ri-translate', 'h-6 w-6 md:h-8 md:w-8')
        </summary>
        <ul class="z-50 dropdown-content bg-base-200 text-base-content rounded-box h-[10vh] max-h-96 w-56 overflow-y-auto shadow">
            <div class="grid grid-cols-1 gap-3 p-3" tabindex="0">
                @foreach(config('app.locales') as $local => $localInfo)
                    <a href="{{ url('lang/'.$local) }}" class="outline-base-content overflow-hidden rounded-lg text-left">
                        <div class="bg-base-100 text-base-content w-full cursor-pointer font-sans">
                            <div class="grid grid-cols-5 grid-rows-3">
                                <div class="col-span-5 row-span-3 row-start-1 flex items-center gap-2 px-4 py-3">
                                    <span class="flag-icons flag-icons-{{ $localInfo['flag'] }}"></span>
                                    {{ str($localInfo['native'])->title() }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </ul>
    </details>
</li>


