@extends('layouts.master')

@section('content')
    @php
        $infoStatus = [
            Information::PENDING => [
                'status' => 'PENDING',
                'css' => 'bg-gradient-secondary',
            ],
            Information::PUBLISHED => [
                'status' => 'PUBLISHED',
                'css' => 'bg-gradient-info',
            ],
            Information::FUTURE => [
                'status' => 'FUTURE',
                'css' => 'bg-gradient-success',
            ],
        ];
    @endphp

    <div class="p-4 bg-secondary">
        <form enctype="multipart/form-data"
            action="{{ isset($info) ? route('web.information.update', $info->id) : route('web.information.store') }}"
            method="POST">

            @csrf
            @isset($info)
                @method('PUT')
            @endisset

            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Title</label>
                <input class="form-control" name="title" type="text" value="{{ isset($info) ? $info->title : '' }}"
                    id="example-text-input">
            </div>
            @if (isset(Session::get('errors')['title']))
                <div class="col-md-4 form-group">
                    @include('components.alert', $data = Session::get('errors')['title'])
                </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Onwer</label>
                        <input readonly class="form-control" type="text" name="description"
                            value="{{ isset($info) ? getUsername($info->user) : (isset($user) ? getUsername($user) : '') }}"
                            id="example-search-input">
                    </div>
                    @if (isset(Session::get('errors')['description']))
                        <div class="form-group">
                            @include('components.alert', $data = Session::get('errors')['description'])
                        </div>
                    @endif
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Status</label>
                        <select name="status" class="form-control">
                            @foreach ($infoStatus as $key => $values)
                                <option value={{ $key }}
                                    {{ isset($info) && $key == $info->status ? 'selected' : ' ' }}>
                                    {{ $values['status'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if (isset(Session::get('errors')['status']))
                        <div class="form-group">
                            @include('components.alert', $data = Session::get('errors')['status'])
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Country</label>
                        <select multiple class="form-control" name="country_id">
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ isset($info) && $country->id == $info->country_id ? 'selected' : ' ' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                        @if (isset(Session::get('errors')['country_id']))
                            <div class="form-group">
                                @include('components.alert', $data = Session::get('errors')['country_id'])
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="example-url-input" class="form-control-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ isset($info) ? $info->description : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="example-tel-input" class="form-control-label">File</label>
                <input class="form-control" name="file" type="file" onchange="changeImage(event)">
            </div>

            @if (isset(Session::get('errors')['file']))
                <div class="col-md-4 form-group">
                    @include('components.alert', $data = Session::get('errors')['file'])
                </div>
            @endif

            <div class="form-group">
                <label for="example-tel-input" class="form-control-label">Preview</label>
                <img class="form-control" id="preview-img" class="col-6 img-thumbnail" style="width: 40rem" alt=""
                    src="{{ isset($info) ? getS3Url($info->image) : '' }}">
            </div>
            <input class="btn btn-success" type="submit" value="Submit">
        </form>
        <script>
            const changeImage = (e) => {
                var preImage = document.getElementById("preview-img")
                preImage.src = URL.createObjectURL(e.target.files[0])
                preImage.onload = () => {
                    URL.revokeObjectURL(output.src)
                }
            }
        </script>
    </div>
@endsection
