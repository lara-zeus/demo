<x-app>
{{--@php
    $repos = config('app.repos');
    $stars= [];

    foreach ($repos as $repo) {
            $getStars = cache()->remember('git-stars-' . $repo, \Illuminate\Support\Carbon::parse('1 day'), function () use ($repo) {
                return \GrahamCampbell\GitHub\Facades\GitHub::repo()->show('lara-zeus', $repo);
            });
            $stars[$repo] = $getStars['stargazers_count'];
            /*$downloads[$repo] = cache()->remember('git-downloads-' . $repo, Carbon::parse('1 day'), function () use ($repo) {
                return PackagistApiServices::getPackageTotalDownloads('lara-zeus/' . $repo);
            });*/
        }
    dd(array_sum(array_values($stars)));
@endphp--}}
    @if(session('current_theme') === 'another-portfolio')
        @include('welcome-another')
    @elseif(session('current_theme') === 'daisy')
        @include('welcome-daisy')
    @else
        @include('welcome-all')
    @endif
</x-app>
