@foreach ($data as $error)
    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>
@endforeach
