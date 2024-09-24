<x-app>
    @if(session('current_theme') === 'another-portfolio')
        @include('welcome-another')
    @elseif(session('current_theme') === 'daisy')
        @include('welcome-daisy')
    @else
        @include('welcome-all')
    @endif
</x-app>
