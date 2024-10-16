<x-app-layout :show-nav="false">
    <div class="container text-center py-5">
        <h1 class="display-4">{{ __('errors.404_title') }}</h1>
        <p>{{ __('errors.404_message') }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary">{{ __('errors.go_home') }}</a>
    </div>
</x-app-layout>
