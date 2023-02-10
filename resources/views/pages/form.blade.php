@extends('layouts.master')

@section('content')
    <div class="p-4 bg-info">
        <form>
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Name</label>
                <input class="form-control" type="text" value="{{ isset($continent) ? $continent->name : '' }}"
                    id="example-text-input">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Region</label>
                        <input class="form-control" type="number"
                            value="{{ isset($continent) ? $continent->quantity_regions : '' }}" id="example-search-input">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Countries</label>
                        <input class="form-control" type="number"
                            value="{{ isset($continent) ? $continent->quantity_countries : '' }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="example-url-input" class="form-control-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{ isset($continent) ? $continent->description : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="example-tel-input" class="form-control-label">File</label>
                <input class="form-control" type="file" onchange="changeImage(event)">
            </div>

            <div class="form-group">
                <label for="example-tel-input" class="form-control-label">Preview</label>
                <img class="form-control" id="preview-img" class="col-6 img-thumbnail" style="width: 40rem" alt=""
                    src="{{ isset($continent) ? $continent->image : '' }}">
            </div>
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
