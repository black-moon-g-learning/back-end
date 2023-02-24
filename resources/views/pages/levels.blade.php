@extends('layouts.master')

@section('content')
    @if (Session::has('response'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>{{ Session::get('response')['status'] ? 'Success' : 'Fail' }}! </strong>
                {{ Session::get('response')['data'] }}
                !</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>levels table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <a href="{{ route('web.levels.create') }}" class="btn bg-gradient-info">Create new Level</a>
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Level</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Action</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($levels as $level)
                                    <tr>
                                        <td>
                                            <img src="{{ getS3Url($level->image) }}" style="width:200px" class="image-thumb"
                                                alt="user1">
                                        </td>
                                        <td>
                                            <h6 class="mb-0 text-sm">{{ $level->name }}
                                            </h6>
                                        </td>
                                        <td class="justify-content-center">
                                            <a href="{{ route('web.levels.edit', $level->id) }}"
                                                class="btn bg-gradient-info" id="click">
                                                Edit</a>
                                            <form method="POST" action="{{ route('web.levels.delete', $level->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn bg-gradient-info delete-level">
                                                    Delete</button>
                                            </form>
                                        </td>
                                        <td class="align-middle">
                                            <p>{{ handleLongText($level->description) }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
@endsection

@section('customCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection

@section('customJs')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script>
        $('.delete-level').click(function(e) {
            e.preventDefault() // Don't post the form, unless confirmed
            $.confirm({
                title: 'Confirm Delete!',
                content: 'Do you want to delete this row!',
                buttons: {
                    confirm: function() {
                        $(e.target).closest('form').submit();
                    },
                    cancel: function() {
                        $.alert('Canceled!');
                    }
                }
            })
        });
    </script>
@endsection
