<div class="container mx-auto my-4 navbar bg-base-300 text-base-content shadow-xl rounded-2xl">
    <div class="flex-1">
        <a class="flex gap-2 btn btn-ghost normal-case text-xl" href="{{ url('/') }}">
            <img class="w-7 mx-auto" src="https://larazeus.com/images/zeus-logo.png" alt="{{ config('zeus.wind.name', config('app.name', 'Laravel')) }}">
            @zeus
        </a>
    </div>
    <div class="flex-none">
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost rounded-btn">
                {{ __('Site') }}
                @svg('ri-arrow-down-s-fill','h-4 w-4 text-base-500 hover:text-base-500 transition-all ease-in-out duration-300')
            </label>

            <div tabindex="0" class="dropdown-content z-[1] card card-compact w-64 p-2 shadow bg-base-200 text-base-content">
                <ul class="menu w-full rounded-box">
                    <li><a href="{{ url('sky') }}">{{ __('Blog') }}</a></li>
                    <li><a href="{{ url('sky/faq') }}">{{ __('Faq') }}</a></li>
                    <li><a href="{{ url('sky/library') }}">{{ __('Library') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost rounded-btn">
                {{ __('Apps') }}
                @svg('ri-arrow-down-s-fill','h-4 w-4 text-base-500 hover:text-base-500 transition-all ease-in-out duration-300')
            </label>

            <div tabindex="0" class="dropdown-content z-[1] card card-compact w-64 p-2 shadow bg-base-200 text-base-content">
                <ul class="menu w-full rounded-box">
                    <li><a href="{{ url('bolt') }}">{{ __('All Forms') }}</a></li>
                    <li><a href="{{ url('thunder') }}">{{ __('All Tickets') }}</a></li>
                    <li><a href="{{ url('wind/contact-us') }}">{{ __('Contact us') }}</a></li>
                </ul>
            </div>
        </div>

        <a href="{{ url('/admin') }}" class="btn btn-ghost rounded-btn">{{ __('Admin') }}</a>

        @include($artemisTheme.'.layouts.theme-switcher')
        @include($artemisTheme.'.layouts.lang-switcher')

        <ul class="menu menu-horizontal">
            @include($artemisTheme.'.layouts.color-switcher')
        </ul>

        @include($artemisTheme.'.layouts.user-switcher')

        <a href="https://github.com/lara-zeus" target="_blank" rel="noreferrer" class="btn btn-ghost rounded-btn">
            @svg('ri-github-fill','h-6 w-6')
        </a>

    </div>
</div>
