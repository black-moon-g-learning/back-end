@extends('layouts.master')
@inject('Information', 'App\Constants\Information')
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
                    <h6>Information table</h6>
                    <a href="{{ route('web.information.create') }}" class="btn bg-success badge-primary" id="click">
                        Create new</a>
                </div>
                <div class="card-header col-2">
                    <label for="chage-status">Filter by status</label>
                    <select class="form-control" id="change-status">
                        <option value="default" disable>Default</option>
                        <option {{ request()->get('status') == $Information::PENDING ? 'selected' : '' }}
                            value="{{ $Information::PENDING }}">PENDING</option>
                        <option {{ request()->get('status') == $Information::PUBLISHED ? 'selected' : '' }}
                            value="{{ $Information::PUBLISHED }}">PUBLISHED
                        </option>
                        <option {{ request()->get('status') == $Information::FUTURE ? 'selected' : '' }}
                            value="{{ $Information::FUTURE }}">FUTURE</option>
                    </select>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center w-100 d-block d-md-table text-nowrap">
                            <thead>
                                <tr>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Title </th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Image</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">Action</th>
                                    <th class=" {{ $common::DEFAULT_HEADER_STYLE }} ">
                                        Country</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Owner</th>
                                    <th class=" {{ $common::DEFAULT_HEADER_STYLE }} ">
                                        Published in</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Status</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Content</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($information as $info)
                                    <tr>
                                        <td class="justify-content-center">
                                            <div class="d-flex flex-wrap">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-break mb-0 text-sm text-truncate">
                                                        {{ handleLongText($info->title) }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="justify-content-center">
                                            <img src="{{ getS3Url($info->image) }}" style="width: 200px" class=" me-3"
                                                alt="user1">
                                        </td>
                                        <td class="align-middle">

                                            <a href={{ route('web.information.edit', $info->id) }}>
                                                <div style="width: 100px" class="btn bg-gradient-info">

                                                    Edit
                                                </div>
                                            </a>
                                            <form method="POST" action="{{ route('web.information.delete', $info->id) }}">

                                                @csrf
                                                @method('DELETE')
                                                <button style="width: 100px" class="btn btn-secondary delete-information"
                                                    type="submit">
                                                    Delete</button>
                                            </form>

                                            @if ($info->status !== $Information::PUBLISHED)
                                                <form method="POST"
                                                    action="{{ route('web.information.send-notification', $info->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button style="width: 100px" class="btn btn-warning push-notification"
                                                        type="submit">
                                                        Push now</button>
                                                </form>
                                            @endif

                                        </td>
                                        <td class="text-center justify-content-center">
                                            <div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6>{{ $info->country->name ?? 'Unknown' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center justify-content-center">
                                            <div class="">
                                                <div class=" flex-column justify-content-center">
                                                    <h6>{{ getUsername($info->user) }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center justify-content-center">
                                            <div class=" ">
                                                <div class=" flex-column justify-content-center">
                                                    {{ $info->published_in ?? 'Unset' }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="justify-content-center">
                                            <div class="    ">
                                                <div class="d-flex flex-column justify-content-center">
                                                    @include('components.status-info.status', [
                                                        'data' => $info->status,
                                                    ])
                                                </div>
                                            </div>
                                        </td>
                                        <td width="220" class="justify-content-center">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="test-123 mb-0 text-sm">
                                                        {{ handleLongText($info->title) }}
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
        {{ $information->links() }}
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
        $('#change-status').on('change', function() {
            var selected = $(this).find(":selected").val();
            if (selected == 'default') {
                window.location.href = `{{ route('web.information') }}`;
            }
            window.location.href = `{{ route('web.information') }}?status=${selected}`;
        });

        $('.delete-information').click(function(e) {
            e.preventDefault() // Don't post the form, unless confirmed
            $.confirm({
                title: 'Confirm delete!',
                content: 'Do you want to delete this row!',
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
        $('.push-notification').click(function(e) {
            e.preventDefault() // Don't post the form, unless confirmed
            $.confirm({
                title: 'Confirm push notification!',
                content: 'Do you want to push notification!',
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
    @include('components.firebase-fcm')
@endsection
