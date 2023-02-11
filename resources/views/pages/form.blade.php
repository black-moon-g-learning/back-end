@extends('layouts.master')

@section('content')
    <div class="p-4 bg-info">
        <form enctype="multipart/form-data" action="{{ route('web.continents.update', $continent->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Name</label>
                <input class="form-control" name="name" type="text"
                    value="{{ isset($continent) ? $continent->name : '' }}" id="example-text-input">
            </div>
            @if (isset(Session::get('errors')['name']))
                <div class="col-md-4 form-group">
                    @include('components.alert', $data = Session::get('errors')['name'])
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Regions</label>
                        <input class="form-control" type="number" name="regions"
                            value="{{ isset($continent) ? $continent->quantity_regions : '' }}" id="example-search-input">
                    </div>
                    @if (isset(Session::get('errors')['regions']))
                        <div class="form-group">
                            @include('components.alert', $data = Session::get('errors')['regions'])
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Countries</label>
                        <input class="form-control" type="number" name="countries"
                            value="{{ isset($continent) ? $continent->quantity_countries : '' }}">
                        @if (isset(Session::get('errors')['countries']))
                            <div class="form-group">
                                @include('components.alert', $data = Session::get('errors')['countries'])
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="example-url-input" class="form-control-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ isset($continent) ? $continent->description : '' }}</textarea>
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
                    src="{{ isset($continent) ? getS3Url($continent->image) : '' }}">
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
