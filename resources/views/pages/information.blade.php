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
                    <h6>Information table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center w-100 d-block d-md-table text-nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 30%">
                                        Title </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image</th>
                                    <th class="text-secondary  opacity-7">Action</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Video</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Country</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Owner</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Content</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($information as $info)
                                    <tr>
                                        <td class="justify-content-center">
                                            <div class="d-flex flex-wrap">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="text-break mb-0 text-sm text-truncate">
                                                        {{ handleLongText($info->title) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="justify-content-center">
                                            <img src="{{ getS3Url($info->image) }}" style="width: 200px" class=" me-3"
                                                alt="user1">
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn bg-gradient-info" onClick="confirm({{ $info->id }})"
                                                id="click"> Edit</button>
                                        </td>
                                        <td class="justify-content-center">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <iframe width="420" height="345" src="{{ $info->video }}">
                                                    </iframe>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="justify-content-center">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $info->country->name }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="justify-content-center">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $info->user->first_name }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="justify-content-center">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $info->status }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="220" class="justify-content-center">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="test-123 mb-0 text-sm">{{ $info->description }}
                                                    </h6>
                                                </div>
                                            </div>
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
