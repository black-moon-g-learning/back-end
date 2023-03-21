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
                    <h6>Questions table</h6>
                </div>
                <div class="col-6 card-header pb-0">
                    <a href="{{ isset($countryId)
                        ? route('web.questions.create', ['country-id' => $countryId])
                        : route('web.questions.create', ['video-id' => $videoId]) }}"
                        class="btn bg-success badge-primary" id="click">
                        Create new question</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE }}">
                                        Question</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE_NOT_CENTER }}">
                                        Answer</th>
                                    <th class="{{ $common::DEFAULT_HEADER_STYLE_NOT_CENTER }}">
                                        Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @isset($questions)
                                    @foreach ($questions as $question)
                                        <tr>
                                            <td>
                                                <div style="width:200px" class="d-flex px-2 py-1">
                                                    <p>{{ handleLongText($question->content) }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    {{ handleLongText($question->correctAnswer()->content ?? 'Answer by image') }}
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <a style="width:120px"
                                                    href="{{ route(
                                                        'web.questions.edit',
                                                        isset($videoId)
                                                            ? ['id' => $question->id, 'video-id' => $videoId]
                                                            : ['country-id' => $countryId, 'id' => $question->id],
                                                    ) }}"
                                                    class="btn bg-gradient-info" id="click"> Edit</a>

                                                <form method="POST"
                                                    action={{ route('web.questions.delete', ['id' => $question->id, 'country-id' => $question->country_id]) }}>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button style="width:120px" class="btn bg-gradient-warning delete-question"
                                                        type="submit" id="click1"> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ isset($countryId) ? $questions->links() : '' }}
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
        $('.delete-question').click(function(e) {
            e.preventDefault() // Don't post the form, unless confirmed
            $.confirm({
                title: 'Confirm Delete!',
                content: 'Do you want to delete this row!, Anwsers in this question will be deleted',
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
