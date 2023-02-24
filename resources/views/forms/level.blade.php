@extends('layouts.master')

@section('content')
    <div class="p-4 bg-secondary">
        <form enctype="multipart/form-data"
            action="{{ isset($level) ? route('web.levels.update', $level->id) : route('web.levels.store') }}" method="POST">

            @csrf

            @isset($level)
                @method('PUT')
            @endisset

            <div class="form-group">
                <label for="example-url-input" class="form-control-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ isset($level) ? $level->description : '' }}</textarea>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Name</label>
                        <input class="form-control" name="name" type="text"
                            value="{{ isset($level) ? $level->name : '' }}" id="example-text-input">
                    </div>
                    @if (isset(Session::get('errors')['name']))
                        <div class="col-md-4 form-group">
                            @include('components.alert', $data = Session::get('errors')['name'])
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="example-tel-input" class="form-control-label">File</label>
                        <input class="form-control" name="file" type="file" onchange="changeImage(event)">
                    </div>
                    @if (isset(Session::get('errors')['file']))
                        <div class="col-md-4 form-group">
                            @include('components.alert', $data = Session::get('errors')['file'])
                        </div>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label for="example-tel-input" class="form-control-label">Preview</label>
                <img class="form-control" id="preview-img" class="col-6 img-thumbnail" style="width: 40rem" alt=""
                    src="{{ isset($level) ? getS3Url($level->image) : '' }}">
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
