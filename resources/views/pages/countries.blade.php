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
                    <h6>Country table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Image</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Country</th>

                                    <th class="text-secondary  opacity-7">Action</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img style="width: 200px" src="{{ getS3Url($country->image) }}"
                                                        alt="user1">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"> {{ $country->name }}
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('web.countries.edit', $country->id) }}"
                                                class="btn bg-gradient-info" id="click"> Edit</a>
                                            <a href="{{ route('web.countries-topics', $country->id) }}"
                                                class="btn bg-gradient-info" id="click"> List topics</a>
                                            <a href="{{ route('web.countries.levels', $country->id) }}"
                                                class="btn bg-gradient-info" id="click"> Level</a>
                                        </td>
                                        <td class=" px-2">
                                            {{-- {{ handleLongText($country->description) }}
                                             --}}
                                            <p class="text-truncate text-break text-center text-md-left"
                                                style="max-width: 200px; font-size: 18px; color: #333;">Lorem ipsum dolor
                                                sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                                labore et dolore magna aliqua.</p>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $countries->appends(['cont' => $continentId ?? 1])->links() }}
    </div>
    @include('components.footer')
@endsection
