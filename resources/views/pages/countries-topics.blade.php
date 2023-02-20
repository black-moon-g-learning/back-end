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

        @isset($country)
            <div class="card">
                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                    <a href="javascript:;" class="d-block">
                        <img style="width: 200px" src="{{ getS3Url($country->image) }}" class="img-fluid border-radius-lg">
                    </a>
                </div>

                <div class="card-body pt-2">
                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                        {{ $country->name }}
                    </a>
                    <p class="card-description mb-4">
                        List topics in this country
                    </p>
                </div>
            </div>
        @endisset


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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Topic</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Total videos</th>
                                    <th class="text-secondary  opacity-7">Action</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countryTopics as $countryTopic)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img style="width: 200px"
                                                        src="{{ getS3Url($countryTopic->topic->image) }}" alt="user1">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"> {{ $countryTopic->topic->name }}
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="justify-content-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $countryTopic->videos_count }}</p>
                                        </td>

                                        <td class="align-middle">
                                            <a href="{{ route('web.topics.edit', $countryTopic->id) }}"
                                                class="btn bg-gradient-info" id="click"> Edit</a>

                                            <form method="POST" action={{ route('web.topics.delete', $countryTopic->id) }}>

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn bg-gradient-info delete-topic" type="submit"
                                                    id="click1"> Delete</button>
                                            </form>
                                        </td>
                                        <td class=" px-2">
                                            {{ handleLongText($countryTopic->description) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $countryTopics->links() }}
    </div>
    @include('components.footer')
@endsection
