@extends('layouts.master')
@inject('common', 'App\Constants\Common')
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
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Image</th>
                                    <th class=" {{ $common::DEFAULT_HEADER_STYLE }} ">
                                        Level</th>
                                    <th class=" {{ $common::DEFAULT_HEADER_STYLE_NOT_CENTER }} ">
                                        Action</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
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
                                            <h6 class="mb-0 text-center">{{ $level->name }}
                                            </h6>
                                        </td>
                                        <td class="justify-content-center">
                                            @if (isset($countryId))
                                                <a href="{{ route('web.questions', $countryId) }}"
                                                    class="btn bg-gradient-info" id="click">
                                                    List</a>
                                            @else
                                                <a style="width:100px" href="{{ route('web.levels.edit', $level->id) }}"
                                                    class="btn bg-gradient-info" id="click">
                                                    Edit</a>
                                                <form method="POST" action="{{ route('web.levels.delete', $level->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="width:100px"
                                                        class="btn bg-gradient-warning delete-level">
                                                        Delete</button>
                                                </form>
                                            @endif

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
