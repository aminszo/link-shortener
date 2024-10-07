@if (session('message'))
    @php
        $message_type = session('message')[0];
        $message_text = session('message')[1];

        $alert_type_class = [
            'info' => 'alert-info',
            'success' => 'alert-success',
            'error' => 'alert-danger',
            'warning' => 'alert-warning',
        ];
    @endphp
    <div class="alert {{ $alert_type_class[$message_type] }}">
        {{ $message_text }}
    </div>
@endif
