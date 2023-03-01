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
                    <h6>Videos table</h6>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <a href="{{ route('web.videos.create', ['ct-id' => $countryTopicId ?? null]) }}"
                            class="btn bg-gradient-info">Create new video</a>
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Videos</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Owner</th>
                                    <th class="text-secondary  opacity-7">Action</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
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
                                        <td class="text-sm">
                                            <button class="btn bg-gradient-info">{{ getUserName($video->user) }}</button>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('web.videos.edit', $video->id) }}"
                                                class="btn bg-gradient-info" id="click">
                                                Edit</a>
                                            <a href="{{ route('web.reviews', $video->id) }}" class="btn bg-gradient-info"
                                                id="click">
                                                Review</a>
                                        </td>
                                        <td class=" px-2">
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
