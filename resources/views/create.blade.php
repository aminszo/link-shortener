<x-app-layout>

    <x-slot:navigation>
        <x-navigation />
    </x-slot>


    <div class="container">
        <div class="row justify-content-center">

            <x-session-message />

            <div class="col-md-8">
                <div class="my-2 form-box">
                    <div class="form-title form-box-header">{{ __('Create New') }}</div>

                    <div class="px-5 pb-3 mt-5">
                        <form action="{{ route('links.store') }}" method="POST" class="mb-4">
                            @csrf

                            <div class="my-4">
                                <label for="destination" class="form-label">{{ __('Destination URL') }}
                                    ({{ __('optional') }}):</label>
                                <input type="text" name="destination" id="destination"
                                    class="form-control form-field @error('destination') is-invalid @enderror"
                                    placeholder="{{ __('https://example-site.com/long-url-address') }}"
                                    value="{{ old('destination') }}" required>
                                <x-show-field-error field="destination" />
                            </div>

                            <div class="my-4">
                                <label for="slug" class="form-label">{{ __('Custom link') }}
                                    ({{ __('optional') }}):</label>
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                        value="{{ parse_url(request()->root())['host'] }}/" disabled>
                                    <input type="text" name="slug" id="slug"
                                        class="form-control form-field @error('slug') is-invalid @enderror"
                                        placeholder="{{ __('short') }}" value="{{ old('slug') }}">
                                    <x-show-field-error field="slug" />
                                </div>
                            </div>


                            <div class="my-4">
                                <label for="title" class="form-label">{{ __('Title') }}
                                    ({{ __('optional') }}):</label>
                                <input type="text" name="title" id='title'
                                    class="form-control form-field @error('title') is-invalid @enderror"
                                    value="{{ old('title') }}">
                                <x-show-field-error field="title" />
                            </div>
                            <div class="my-4">
                                <label for="description" class="form-label">{{ __('Description') }}
                                    ({{ __('optional') }}):</label>
                                <input type="text" name="description" id="description"
                                    class="form-control form-field @error('description') is-invalid @enderror"
                                    value="{{ old('description') }}">
                                <x-show-field-error field="description" />
                            </div>

                            <div class="my-4">
                                <label for="visits_limit" class="form-label">{{ __('Clicks limit') }}
                                    ({{ __('optional') }}):</label>
                                <input type="number" name="visits_limit" id="visits_limit"
                                    class="form-control form-field  @error('visits_limit') is-invalid @enderror"
                                    placeholder="{{ __('Unlimited by default') }}" value="{{ old('visits_limit') }}">
                                <x-show-field-error field="visits_limit" />
                            </div>

                            <div class="my-4">
                                <label for="expires_at" class="form-label">{{ __('Expire date') }}
                                    ({{ __('optional') }}):</label>
                                <input type="date" name="expires_at" id="expires_at"
                                    class="form-control form-field  @error('expires_at') is-invalid @enderror">
                                <x-show-field-error field="expires_at" />
                            </div>


                            <!-- Submit Button -->
                            <div class="mb-0 mt-5">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary w-100 primary-button">
                                        {{ __('Shorten') }}
                                    </button>
                                </div>
                            </div>

                            {{-- @if ($errors->any())
                                <div class="alert alert-danger mt-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
