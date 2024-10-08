<form action="{{ route('links.update', $link) }}" method="POST" class="mb-4">
    @csrf
    @method('PUT')

    <div class="my-2">
        <label for="destination">{{ __('Destination URL') }} ({{ __('optional') }}):</label>
        <input type="text" name="destination" id="destination" class="form-control"
            placeholder="{{ __('https://example-site.com/long-url-address') }}" value="{{ $link->destination }}"
            required>
    </div>

    <div class="my-2">
        <label for="slug">{{ __('Custom link') }} ({{ __('optional') }}):</label>
        <div class="input-group">
            <input type="text" class="form-control" value="{{ parse_url(request()->root())['host'] }}/" disabled>
            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                placeholder="{{ __('short') }}" value="{{ $link->slug }}">
            <x-show-field-error field="slug" />
        </div>
    </div>

    <div class="my-2">
        <label for="title">{{ __('Title') }} ({{ __('optional') }}):</label>
        <input type="text" name="title" id='title' class="form-control" value="{{ $link->title }}">
    </div>
    <div class="my-2">
        <label for="description">{{ __('Description') }} ({{ __('optional') }}):</label>
        <input type="text" name="description" id="description" class="form-control"
            value="{{ $link->description }}">
    </div>

    <div class="my-2">
        <label for="visits_limit">{{ __('visits limit') }} ({{ __('optional') }}):</label>
        <input type="number" name="visits_limit" id="visits_limit" class="form-control"
            placeholder="{{ __('Unlimited by default') }}" value="{{ $link->visits_limit }}">
    </div>

    <div class="my-2">
        <label for="expires_at">{{ __('Expire date') }} ({{ __('optional') }}):</label>
        <input type="date" name="expires_at" id="expires_at" class="form-control" value="{{ $link->expires_at }}">
    </div>


    <!-- Submit Button -->
    <div class="mb-0">
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary w-100 primary-button">
                {{ __('Update') }}
            </button>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
