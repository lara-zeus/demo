<div class="dropdown dropdown-bottom dropdown-right">
    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
            @auth()
                <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl(auth()->user()) }}" alt="avatar" />
            @else
                Guest
            @endauth
        </div>
    </label>

    <div tabindex="0" class="dropdown-content z-[1] card card-compact w-64 p-2 shadow bg-base-200 text-base-content">
        <ul class="menu w-full rounded-box">
            <li><a href="{{ url('dynamic-dashboard') }}">{{ __('My Dashboard') }}</a></li>
            <li><a href="{{ url('bolt/entries') }}">{{ __('My Entries') }}</a></li>
            <li><a href="{{ url('thunder/tickets') }}">{{ __('My Tickets') }}</a></li>
        </ul>
    </div>
</div>
