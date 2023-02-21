@extends('layouts.master')

@section('content')
    <div class="p-4 bg-secondary">
        <form enctype="multipart/form-data"
            action="{{ isset($video) ? route('web.videos.edit', $video->id) : route('web.topics.store') }}" method="POST">

            @csrf

            @isset($video)
                @method('PUT')
            @endisset

            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Name</label>
                <input class="form-control" name="name" type="text" value="{{ isset($video) ? $video->name : '' }}"
                    id="example-text-input">
            </div>
            @if (isset(Session::get('errors')['name']))
                <div class="col-md-4 form-group">
                    @include('components.alert', $data = Session::get('errors')['name'])
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Author</label>
                        <input class="form-control" type="text" name="total video"
                            value="{{ isset($video) ? getUsername($video->user) : '' }}" id="example-search-input">
                    </div>
                    @if (isset(Session::get('errors')['regions']))
                        <div class="form-group">
                            @include('components.alert', $data = Session::get('errors')['total video'])
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Duration</label>
                        <input class="form-control" type="text" name="total video"
                            value="{{ isset($video) ? convertTimeFromDB($video->time) : '' }}" id="example-search-input">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="example-url-input" class="form-control-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ isset($video) ? $video->description : '' }}</textarea>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="example-tel-input" class="form-control-label">Image</label>
                    <input class="form-control" name="file" type="file" onchange="changeImage(event)">
                    @if (isset(Session::get('errors')['file']))
                        <div class="col-md-4 form-group">
                            @include('components.alert', $data = Session::get('errors')['file'])
                        </div>
                    @endif
                </div>
                <div class="form-group col-6">
                    <label for="example-tel-input" class="form-control-label">Preview</label>
                    <img class="form-control" id="preview-img" class="col-6 img-thumbnail" style="width: 30rem"
                        alt="" src="{{ isset($video) ? getS3Url($video->image) : '' }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label for="example-tel-input" class="form-control-label">Video</label>
                    <input class="form-control" name="file" type="file" onchange="changeImage(event)">
                    @if (isset(Session::get('errors')['file']))
                        <div class="col-md-4 form-group">
                            @include('components.alert', $data = Session::get('errors')['file'])
                        </div>
                    @endif
                </div>
                <div class="form-group col-6">
                    <label for="example-tel-input" class="form-control-label">Preview</label>
                    <img class="form-control" id="preview-img" class="col-6 img-thumbnail" style="width: 30rem"
                        alt="" src="{{ isset($video) ? getS3Url($video->image) : '' }}">
                </div>
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
