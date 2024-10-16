<x-app-layout :show-nav="false">
    <div class="container text-center py-5">
        <h1 class="display-4">{{ __('errors.inactive_link_title') }}</h1>
        <p>{{ __('errors.inactive_link_message') }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary">{{ __('errors.go_home') }}</a>
    </div>
</x-app-layout>
