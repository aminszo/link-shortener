<x-app-layout>

    <div class="container py-4">
        <div class="row justify-content-center">

            <x-session-message />

            <div class="col-md-8">

                @foreach ($links as $link)
                    <div class="link-box">
                        <div class="link-item-header">{{ $link->title }}</div>

                        <div class="link-item-body">

                            @php
                                $base_domain = parse_url(request()->root())['host'];
                                $full_url = $base_domain . '/' . $link->slug;
                                $created_at = substr($link->created_at, 0, 10);
                            @endphp
                            <p>
                                <b><a href="{{ $link->slug }}">{{ $full_url }}</a></b>
                            </p>
                            <p class="link-destination">
                                <a href="{{ $link->destination }}">{{ $link->destination }}</a>
                            </p>
                            <p>
                                <span class="me-4"><i class="fa-solid fa-chart-simple"></i> Visits : {{ $link->visits_count }}</span>
                                <span><i class="fa-regular fa-calendar"></i> {{ $created_at }}</span>
                            </p>
                            <p>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $link->id }}" aria-expanded="false"
                                    aria-controls="collapse-{{ $link->id }}">
                                    {{ __('More') }}
                                </button>
                                <a href="{{ route('links.edit', $link) }}" class="btn btn-warning">Edit</a>
                                <x-delete-link-button :link="$link" />

                            </p>

                            <div class="collapse" id="collapse-{{ $link->id }}">
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
