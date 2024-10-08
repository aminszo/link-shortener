<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">

            <x-session-message />

            <div class="col-md-8">

                <div class="card my-2">
                    <div class="card-header">{{ __('Edit Link') }}</div>

                    <div class="card-body">
                        <x-edit-link-form :link="$link" />
                    </div>
                </div>

                <div class="card my-2">
                    <div class="card-header">{{ __('Delete Link') }}</div>

                    <div class="card-body">
                        <x-delete-link-form :link="$link" />
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
