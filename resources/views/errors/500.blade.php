@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message')
    <div class="text-sm text-gray-400 font-sans">Error Code: {{ app('sentry')->getLastEventId() }}</div>
    {{ __('Server Error') }}
    <br>
    <p class="text-lg tracking-normal text-primary-500">
        will be fixed soon
    </p>
@endsection
