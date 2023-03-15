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
                    <h6>Videos table</h6>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <a href="{{ route('web.videos.create', ['ct-id' => $countryTopicId ?? null]) }}"
                            class="btn bg-gradient-info">Create new video</a>
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Image</th>
                                    <th class=" {{ $common::DEFAULT_HEADER_STYLE }}">
                                        Name</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Videos</th>
                                    <th class=" {{ $common::DEFAULT_HEADER_STYLE_NOT_CENTER }} ">
                                        Owner</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE_NOT_CENTER }}">Action</th>
                                    <th class=" {{ $common::DEFAULT_HEADER_STYLE }}">
                                        Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($videos as $video)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1 flex-column justify-content-center">
                                                <img src="{{ getS3Url($video->image) }}" style="width:200px"
                                                    class="image-thumb" alt="user1">
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0 text-sm">{{ $video->name }}
                                            </h6>
                                        </td>
                                        <td class="justify-content-center">
                                            <iframe width="300" height="250"
                                                src="{{ handleShowVideoLink($video->url) }}" frameborder="0"
                                                allowfullscreen></iframe>

                                        </td>
                                        <td>
                                            <button style="width:150px"
                                                class="btn bg-gradient-success">{{ getUserName($video->user) }}</button>
                                        </td>
                                        <td class="align-middle">
                                            <a style="width:100px" href="{{ route('web.videos.edit', $video->id) }}"
                                                class="btn bg-gradient-info" id="click">
                                                Edit</a>
                                            <br />
                                            <a style="width:100px" href="{{ route('web.reviews', $video->id) }}"
                                                class="btn bg-gradient-success" id="click">
                                                Review</a>
                                            <form action="{{ route('web.videos.delete', $video->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button style="width:100px" class="btn bg-gradient-warning delete-video"
                                                    id="click">
                                                    Delete</button>
                                            </form>
                                        </td>
                                        <td class="text-center px-2">
                                            {{ convertTimeFromDB($video->time) }}
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
        $('.delete-video').click(function(e) {
            e.preventDefault() // Don't post the form, unless confirmed
            $.confirm({
                title: 'Confirm delete video!',
                content: 'Do you want to delete this video!',
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
