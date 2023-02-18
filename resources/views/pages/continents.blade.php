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
                    <h6>Continents table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Continent</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Regions</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Countries</th>
                                    <th class="text-secondary  opacity-7">Action</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($continents as $continent)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ getS3Url($continent->image) }}"
                                                        class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $continent->name }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="justify-content-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $continent->quantity_regions }}</p>
                                        </td>
                                        <td class="text-sm">
                                            <span
                                                class="badge badge-sm bg-gradient-success">{{ $continent->countries_count }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn bg-gradient-info" onClick="confirm({{ $continent->id }})"
                                                id="click"> Edit</button>
                                            <a href="{{ route('web.countries', ['cont' => $continent->id]) }}"
                                                class="btn bg-gradient-info" id="click"> Countries</a>
                                        </td>
                                        <td class=" px-2">
                                            {{ $continent->description }}
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
        function confirm(id) {
            $.confirm({
                title: 'Confirm Edit!',
                content: 'Do you want to edit this row!',
                buttons: {
                    confirm: function() {
                        window.location.href = "{{ route('web.continents.edit', $continent->id) }}"
                    },
                    cancel: function() {
                        $.alert('Canceled!');
                    }
                }
            })
        };
        $('#click1').confirm({
            title: 'Confirm!',
            content: 'Simple confirm!',
            buttons: {
                confirm: function() {
                    $.ajax({
                        url: 'http://g-learning.vn/api/continents',
                        dataType: "json",
                        type: "GET",
                        async: true,
                        data: {},
                        success: function(data) {
                            alert(33)
                        },
                        error: function(xhr, exception) {
                            var msg = "";
                            if (xhr.status === 0) {
                                msg = "Not connect.\n Verify Network." + xhr.responseText;
                            } else if (xhr.status == 404) {
                                msg = "Requested page not found. [404]" + xhr.responseText;
                            } else if (xhr.status == 500) {
                                msg = "Internal Server Error [500]." + xhr.responseText;
                            } else if (exception === "parsererror") {
                                msg = "Requested JSON parse failed.";
                            } else if (exception === "timeout") {
                                msg = "Time out error." + xhr.responseText;
                            } else if (exception === "abort") {
                                msg = "Ajax request aborted.";
                            } else {
                                msg = "Error:" + xhr.status + " " + xhr.responseText;
                            }
                            console.log(msg)
                        }
                    });
                },
                cancel: function() {
                    $.alert('Canceled!');
                },
            }
        })
    </script>
@endsection
