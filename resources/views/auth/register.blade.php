<x-app-layout>

    <div class="container py-4">
        <div class="row justify-content-center px-3 px-md-0">

            <x-session-message />

            <div class="col-md-8 form-box px-5 py-4 mt-3">

                <div class="form-title text-center mb-4">
                    {{ __('Register') }}
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="my-4">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text"
                            class="form-control form-field @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <x-show-field-error field="name" />
                    </div>

                    <div class="my-4">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email"
                            class="form-control form-field @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">
                        <x-show-field-error field="email" />
                    </div>

                    <div class="my-4">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control form-field @error('password') is-invalid @enderror" name="password"
                            required autocomplete="new-password">
                        <x-show-field-error field="password" />
                    </div>

                    <div class="my-4">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control form-field"
                            name="password_confirmation" required>
                        <x-show-field-error field="password_confirmation" />
                    </div>

                    <div class="mb-0 mt-4">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-100 primary-button">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                </form>

                <p class="mt-4 form-note">
                    {{ __('Already registered?') }}
                    <a href="{{ route('login') }}"
                        class="primary-light-text text-decoration-underline">{{ __('Login') }}</a>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
