<x-app-layout>

    <x-slot:navigation>
        <x-navigation />
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">

            <x-session-message />

            <div class="col-md-8">

                @foreach ($links as $link)
                    <div class="card my-2">
                        <div class="card-header">{{ $link->title }}</div>

                        <div class="card-body">
                            <div>
                                Link : <a href="">{{request()->root()}}/{{ $link->slug }}</a>
                            </div>
                            <div>
                                Destination: {{ $link->destination }}
                            </div>
                            <div>
                                Visits Count : {{ $link->visits_count }}
                            </div>
                            <p>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{$link->id}}" aria-expanded="false" aria-controls="collapse-{{$link->id}}">
                                    {{__('More')}}
                                </button>
                            </p>

                            <div>
                                <a href="{{ route('links.edit', $link) }}" class="btn btn-warning">Edit</a>
                            </div>

                            <div class="collapse" id="collapse-{{$link->id}}">
                                <p>
                                    {{ __('Created at') }}: {{ $link->created_at }}
                                </p>
                                <p>
                                    {{ __('Visits limit') }}: {{ $link->visits_limit }}
                                </p>
                                <p>
                                    {{ __('Last visit date') }}: {{ $link->last_visited_at }}
                                </p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
