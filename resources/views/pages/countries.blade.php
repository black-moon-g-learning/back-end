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
                    <h6>Country table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Image</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Country</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE_NOT_CENTER }}">Action</th>
                                    <th class=" {{ $common::DEFAULT_HEADER_STYLE }}">
                                        Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>
                                            <div>
                                                <div>
                                                    <img style="width: 200px" src="{{ getS3Url($country->image) }}"
                                                        alt="user1">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class=" text-center justify-content-center">
                                                <h6> {{ $country->name }}
                                                </h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="justify-content-center">
                                                <a style="width:120px"
                                                    href="{{ route('web.countries.edit', $country->id) }}"
                                                    class=" btn bg-gradient-info" id="click"> Edit</a>
                                                <br />
                                                <a style="width:120px"
                                                    href="{{ route('web.countries-topics', $country->id) }}"
                                                    class="btn bg-gradient-success" id="click"> List topics</a>
                                                <br />
                                                <a style="width:120px"
                                                    href="{{ route('web.countries.levels', $country->id) }}"
                                                    class="btn bg-gradient-warning" id="click"> Level</a>
                                            </div>
                                        </td>
                                        <td class="">
                                            {{ handleLongText($country->description) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $countries->appends(['cont' => $continentId])->links() }}
    </div>
    @include('components.footer')
@endsection
