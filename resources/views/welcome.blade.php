<x-app-layout>

    <header class="text-white text-center py-5" style="background-color: rgb(44 34 77)">
        <div class="container">
            <h1>Shorten Your Links</h1>
            <p class="lead">Simplify your URLs, track visits, and customize your links with ease</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">Get Started</a>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="card shadow homepage-card">
                        <div class="card-body">
                            <h5 class="card-title">Easy Link Shortening</h5>
                            <p class="card-text">Create short, memorable links in seconds and share them anywhere.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow homepage-card">
                        <div class="card-body">
                            <h5 class="card-title">Customizable Links</h5>
                            <p class="card-text">Personalize your links with custom slugs for better branding.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow homepage-card">
                        <div class="card-body">
                            <h5 class="card-title">Track Visits</h5>
                            <p class="card-text">Monitor your link's performance with detailed visit analytics.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: rgb(159 151 183)">
        <div class="container text-center">
            <h2 class="mb-4">Why Choose Our Link Shortener?</h2>
            <p class="lead">Our platform is designed for simplicity, efficiency, and reliability. Whether you're a
                casual user or a business, we have the tools you need to make link management effortless.</p>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>&copy; {{ date('Y') }} Link Shortener. All rights reserved.</p>
        </div>
    </footer>



</x-app-layout>
