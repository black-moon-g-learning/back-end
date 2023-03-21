@extends('layouts.master')
@inject('common', 'App\Constants\Common')
@section('content')
    @if (Session::has('response'))
        <div class="alert  {{ Session::get('response')['status'] ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show"
            role="alert">
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
        @include('components.modal', ['remainTopics' => $remainTopics, 'country' => $country])
        <div class="col-12">
            <div class=" row card mb-4">
                <div class=" col-6 card-header pb-0">
                    <h6>Topics table</h6>
                </div>
                <div class="col-6 card-header pb-0">
                    <button data-bs-toggle="modal" data-bs-target="#modal-form" class="btn bg-success badge-primary"
                        id="click">
                        Create new topic</button>
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
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }} ">
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
                                            <div class="d-flex text-center flex-column justify-content-center">
                                                <h6> {{ $countryTopic->topic->name }}
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="text-center justify-content-center">
                                            <p class="font-weight-bold">
                                                {{ $countryTopic->videos_count }}</p>
                                        </td>

                                        <td class="align-middle">
                                            <a style="width:120px"
                                                href="{{ route('web.countries-topics.videos', $countryTopic->id) }}"
                                                class="btn bg-gradient-info" type="submit" id="click1">
                                                List videos</a>
                                            <form method="POST"
                                                action={{ route('web.countries-topics.delete', $countryTopic->id) }}>

                                                @csrf
                                                @method('DELETE')

                                                <button style="width:120px" class="btn bg-gradient-warning delete-topic"
                                                    type="submit" id="click1"> Delete</button>
                                            </form>

                                        </td>
                                        <td class=" px-2">
                                            {{ handleLongText($countryTopic->topic->description) }}
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
    @include('components.modal')
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
                title: 'Confirm Edit!',
                content: 'Do you want to edit this row!',
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
    <script>
        $('.create-topic').click(function(e) {
            e.preventDefault() // Don't post the form, unless confirmed
            $.confirm({
                title: 'Confirm Add new!',
                content: 'Do you want to add new topic !',
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
