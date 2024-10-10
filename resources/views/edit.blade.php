<x-app-layout>

    <div class="container py-4">
        <div class="row justify-content-center">

            <x-session-message />

            <div class="col-md-8">

                <div class="form-box my-2">
                    <div class="form-title form-box-header">{{ __('Edit Link') }}</div>

                    <div class="px-5 pb-3 mt-5">
                        <x-edit-link-form :link="$link" />
                    </div>
                </div>

                <div class="form-box my-2">
                    <div class="form-title form-box-header">{{ __('Delete Link') }}</div>

                    <div class="px-5 py-3">
                        <x-delete-link-form :link="$link" />
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
