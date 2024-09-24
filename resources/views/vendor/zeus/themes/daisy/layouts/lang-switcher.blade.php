<div class="dropdown">
    <label tabindex="0" class="btn btn-ghost rounded-btn">
        @svg('tabler-language-katakana','h-5 w-5')
        @svg('tabler-chevron-down','h-4 w-4 text-base-500 hover:text-base-500 transition-all ease-in-out duration-300')
    </label>

    <div tabindex="0" class="dropdown-content z-[1] card card-compact w-64 p-2 shadow bg-base-200 text-base-content">
        <ul class="menu w-full rounded-box">
            @foreach(config('app.locales') as $local => $localInfo)
                <li>
                    <a class="ltr:text-left rtl:text-right" href="{{ url('lang/'.$local) }}">
                        <span class="flag-icons flag-icons-{{ $localInfo['flag'] }}"></span>
                        {{ str($localInfo['native'])->title() }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
