<x-app-layout>
    
    <div class="container">
        <div class="row justify-content-center px-4 px-md-0">
            <div class="col-md-8 form-box px-5 pt-5 pb-3 mt-5">

                <div class="form-title text-center mb-4">
                    {{ __('Login to account') }}
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <input id="email" type="email" class="form-control form-field" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="{{ __('Email') }}">
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <input id="password" type="password" class="form-control form-field" name="password" required
                            placeholder="{{ __('Password') }}">
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-0">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-100 primary-button">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                    <!-- Validation Errors Section -->
                    @if ($errors->any())
                        <div class="mt-3 error-message">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>

                @if (Route::has('register'))
                    <p class="mt-4 form-note">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}"
                            class="primary-light-text text-decoration-underline">{{ __('Register') }}</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
