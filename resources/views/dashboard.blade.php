<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">

            <x-session-message />

            <div class="col-md-8">

                <div class="card my-2">
                    <div class="card-header">{{ __('Create New') }}</div>

                    <div class="card-body">
                        <x-create-new-link-form />
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        {{ __("You're logged in!") }}
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Destination</th>
                            <th>Visits</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($links as $link)
                            <tr>
                                <td>{{ $link->title }}</td>
                                <td>{{ $link->slug }}</td>
                                <td>{{ $link->destination }}</td>
                                <td>{{ $link->visits_count }}</td>
                                <td>
                                    <a href="{{ route('links.edit', $link) }}" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
