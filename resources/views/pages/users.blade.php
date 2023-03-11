@inject('process', 'App\Constants\Process')
@inject('constantUser', 'App\Constants\User')
@extends('layouts.master')

@section('content')
    <div class="row">
        @if (Session::has('response'))
            <div class="alert  {{ Session::get('response')['status'] ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show"
                role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>{{ Session::get('response')['status'] ? 'Success' : 'Fail' }}! </strong>
                    {{ Session::get('response')['message'] }}
                    !</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Users table</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Avatar</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email</th>
                                    <th class="text-secondary  opacity-7">Status</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Phone</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Expired</th>
                                    <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                        Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <img src="{{ getS3Url($user->image) }}" style="width: 200px" alt="user1">
                                        </td>
                                        <td class="justify-content-center">
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ getUsername($user) }}</p>
                                        </td>
                                        <td class="justify-content-center">
                                            <span
                                                class="justify-content-center badge badge-sm bg-gradient-success">{{ $user->email }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <form method='POST' action="{{ route('web.users.update-status', $user->id) }}">

                                                @csrf
                                                @method('PUT')

                                                <input name="status" value="{{ showStatusUser($user->status) }}"
                                                    type="hidden" />
                                                <button
                                                    class="btn {{ showStatusUser($user->status) === 'ACTIVE' ? 'bg-gradient-info' : 'bg-gradient-warning' }}  update-user"
                                                    type="submit" id="click1">{{ showStatusUser($user->status) }}
                                                </button>

                                            </form>
                                        </td>
                                        <td class=" px-2">
                                            {{ $user->phone }}
                                        </td>
                                        <td class=" px-2">
                                            {{ $user->expired ?? 'Payment successful' }}
                                        </td>
                                        <td class=" px-2">
                                            @php
                                                $isPaid = $user->payment->first();
                                            @endphp
                                            <button
                                                class="btn {{ isset($isPaid) && $isPaid->process == $process::SUCCESS ? 'bg-gradient-primary' : 'bg-gradient-success' }} "
                                                onClick="confirm({{ $user->id }})" id="click">
                                                {{ isset($isPaid) && $isPaid->process == $process::SUCCESS ? 'yes' : 'no' }}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $users->links() }}
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
        $('.update-user').click(function(e) {
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
@endsection
