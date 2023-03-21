@php
    $status = [
        'DOING' => 'btn-success',
        'SUCCESS' => 'btn-warning',
        'FAIL' => 'btn-primary',
    ];
@endphp
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
                    <h6>Services table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        User </th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Order id</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE_NOT_CENTER }}">
                                        Process</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Price</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Service</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Payment</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userPayments as $userPayment)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-center"> {{ getUsername($userPayment->user) }}
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="justify-content-center">
                                            <p class="text-center">
                                                {{ $userPayment->order_id }} </p>
                                        </td>
                                        <td class="justify-content-center">
                                            <p class="btn {{ $status[$userPayment->process] }} text-center">
                                                {{ $userPayment->process }} </p>
                                        </td>
                                        <td class="justify-content-center">
                                            <p class="text-center">
                                                {{ $userPayment->service->price }} Vnđ</p>
                                        </td>
                                        <td class="justify-content-center">
                                            <p class="text-center">
                                                {{ $userPayment->service->name }} </p>
                                        </td>
                                        <td class="justify-content-center">
                                            <p class="text-center">
                                                {{ $userPayment->payment }} </p>
                                        </td>
                                        <td class="justify-content-center">
                                            <p class="text-center">
                                                {{ $userPayment->created_at }} </p>
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
        $('.delete-service').click(function(e) {
            e.preventDefault() // Don't post the form, unless confirmed
            $.confirm({
                title: 'Confirm Delete!',
                content: 'Do you want to delete this row!, video in this service will be deleted',
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
