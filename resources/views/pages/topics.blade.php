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
            <div class=" row card mb-4">
                <div class=" col-6 card-header pb-0">
                    <h6>Topics table</h6>
                </div>
                <div class="col-6 card-header pb-0">
                    <a href="{{ route('web.topics.create') }}" class="btn bg-success badge-primary" id="click">
                        Create new topic</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Image</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Topic</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Total videos</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE_NOT_CENTER }}">Action</th>
                                    <th class=" {{ $common::DEFAULT_HEADER_STYLE }}">
                                        Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topics as $topic)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img style="width: 200px" src="{{ getS3Url($topic->image) }}"
                                                        alt="user1">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center flex-column justify-content-center">
                                                <h6 class=""> {{ $topic->name }}
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="text-center justify-content-center">
                                            <p class=" font-weight-bold ">
                                                {{ $topic->videos_count }}</p>
                                        </td>

                                        <td class="align-middle">
                                            <a style="width:100px" href="{{ route('web.topics.edit', $topic->id) }}"
                                                class="btn bg-gradient-info text-center" id="click"> Edit</a>

                                            <form method="POST" action={{ route('web.topics.delete', $topic->id) }}>

                                                @csrf
                                                @method('DELETE')

                                                <button style="width:100px" class="btn bg-gradient-warning delete-topic"
                                                    type="submit" id="click1"> Delete</button>
                                            </form>
                                        </td>
                                        <td class=" px-2">
                                            {{ handleLongText($topic->description) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $topics->links() }}
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
        $('.delete-topic').click(function(e) {
            e.preventDefault() // Don't post the form, unless confirmed
            $.confirm({
                title: 'Confirm Delete!',
                content: 'Do you want to delete this row!, video in this topic will be deleted',
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
