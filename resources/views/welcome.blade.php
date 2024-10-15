<x-app-layout>

    <header class="text-white text-center py-5" style="background-color: rgb(44 34 77)">
        <div class="container">
            <h1>{{__('welcome.title')}}</h1>
            <p class="lead">{{__('welcome.description')}}</p>
            <a href="{{ route('login') }}" class="btn btn-light btn-lg">{{__('welcome.call_to_action')}}</a>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="card shadow homepage-card">
                        <div class="card-body">
                            <h5 class="card-title">{{__('welcome.feature_1')}}</h5>
                            <p class="card-text">{{__('welcome.feature_1_text')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-sm-0 mt-3">
                    <div class="card shadow homepage-card">
                        <div class="card-body">
                            <h5 class="card-title">{{__('welcome.feature_2')}}</h5>
                            <p class="card-text">{{__('welcome.feature_2_text')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-sm-0 mt-3">
                    <div class="card shadow homepage-card">
                        <div class="card-body">
                            <h5 class="card-title">{{__('welcome.feature_3')}}</h5>
                            <p class="card-text">{{__('welcome.feature_3_text')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: rgb(159 151 183)">
        <div class="container text-center">
            <h2 class="mb-4">{{__('welcome.why_choose_us')}}</h2>
            <p class="lead">{{__('welcome.why_choose_us_text')}}</p>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}</p>
        </div>
    </footer>



</x-app-layout>
