@php
    $formAnswers = [
        [
            'character' => 'A',
            'bg' => 'bg-success',
        ],
        [
            'character' => 'B',
            'bg' => 'bg-warning',
        ],
        [
            'character' => 'C',
            'bg' => 'bg-info',
        ],
        [
            'character' => 'D',
            'bg' => 'bg-primary',
        ],
    ];
@endphp
@extends('layouts.master')

@section('content')
    <div class="p-4 bg-secondary">
        <form method="POST"
            action="{{ isset($question) ? route('web.questions.update', $question->id) : route('web.questions.store', ['country-id' => $countryId]) }}">

            @csrf
            @isset($question)
                @method('PUT')
            @endisset

            <div class="row">
                <h2>1. Question</h2>
                <div class="form-group col-md-12">
                    <div class="input-group mb-4 alert alert-secondary">
                        <input class="form-control" name="question" value="{{ isset($question) ? $question->content : '' }}"
                            placeholder="Question" type="text">
                    </div>
                    @if (isset(Session::get('errors')['question']))
                        <div class=" form-group">
                            @include('components.alert', $data = Session::get('errors')['question'])
                        </div>
                    @endif
                </div>
            </div>
            <input type="hidden" name="correct_answer" value="" class="hidden-correct" />
            <div class="row">
                @php
                    $index = 0;
                @endphp
                @foreach ($formAnswers as $formAnswer)
                    @isset($question->answers)
                        @php
                            $answer = $question->answers->get($index);
                        @endphp
                    @endisset
                    <div class="col-md-6">
                        <div class="form-group">
                            <div id="{{ $answer->id ?? $formAnswer['character'] }}"
                                class="{{ $formAnswer['character'] }} input-group input-answer mb-4 alert  {{ isset($answer) && $answer->is_correct == 1 ? 'alert-warning' : 'alert-secondary' }}">
                                <span class="input-group-text {{ $formAnswer['bg'] }}">{{ $formAnswer['character'] }}</span>
                                <input value="{{ $answer->content ?? '' }}"
                                    name="answers[{{ $answer->id ?? $formAnswer['character'] }}]" class="form-control"
                                    placeholder="Anwser" type="text">
                            </div>
                        </div>
                        @if (isset(Session::get('errors')['answers.' . ($answer->id ?? $formAnswer['character'])]))
                            <div class=" form-group">
                                @include(
                                    'components.alert',
                                    $data = Session::get('errors')[
                                        'answers.' . ($answer->id ?? $formAnswer['character'])
                                    ]
                                )
                            </div>
                        @endif
                    </div>
                    @php
                        $index++;
                    @endphp
                @endforeach

            </div>
            <div class="row">
                <div class="form-group col-1">
                    <label for="exampleFormControlSelect1">Correct Answer</label>
                    <select class="form-control" id="correct">
                        @php
                            $index = 0;
                        @endphp
                        @foreach ($formAnswers as $formAnswer)
                            @isset($question->answers)
                                @php
                                    $answer = $question->answers->get($index);
                                @endphp
                            @endisset
                            <option {{ isset($answer->is_correct) && $answer->is_correct ? 'selected' : '' }}
                                class=" {{ $formAnswer['bg'] }}">
                                {{ $formAnswer['character'] }}
                            </option>
                            @php
                                $index++;
                            @endphp
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="btn btn-success" type="submit">Save</button>
        </form>
    </div>
@endsection

@section('customCss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection

@section('customJs')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script type="text/javascript">
        $('.hidden-correct').val($('.input-answer.alert-warning').attr('id'));

        $('#correct').change(function() {
            $('.input-answer').removeClass('alert-warning');
            $('.input-answer').addClass('alert-secondary');

            $(`.${$(this).val()}`).addClass('alert-warning');
            $('.hidden-correct').val($('.input-answer.alert-warning').attr('id'));
        });
    </script>
@endsection
