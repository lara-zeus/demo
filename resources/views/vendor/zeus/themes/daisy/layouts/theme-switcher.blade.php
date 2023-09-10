<div class="dropdown">
    <label tabindex="0" class="btn btn-ghost rounded-btn">
        @svg('bi-brush','h-5 w-5')
        @svg('ri-arrow-down-s-fill','h-4 w-4 text-base-500 hover:text-base-500 transition-all ease-in-out duration-300')
    </label>

    <div tabindex="0" class="dropdown-content z-[1] card card-compact w-64 p-2 shadow bg-base-200 text-base-content">
        <ul class="menu w-full rounded-box">
            @foreach(array_keys(config('zeus.themes')) as $theme)
                <li>
                    <a href="{{ url('theme/'.$theme) }}" class="flex items-center justify-start">
                        @svg(config('zeus.themes-icons.'.$theme),'w-6 h-6 text-primary-500')
                        {{ str($theme)->title() }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>


