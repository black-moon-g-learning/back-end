@extends('layouts.master')
@inject('countryStatus', 'App\Constants\Country')
@section('content')
    <div class="p-4 bg bg-secondary">
        <form enctype="multipart/form-data" action="{{ route('web.countries.update', $country->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Name</label>
                <input class="form-control" name="name" type="text" value="{{ isset($country) ? $country->name : '' }}"
                    id="example-text-input">
            </div>
            @if (isset(Session::get('errors')['name']))
                <div class=" form-group">
                    @include('components.alert', $data = Session::get('errors')['name'])
                </div>
            @endif
            <div class="form-group">
                <label for="example-url-input" class="form-control-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ isset($country) ? $country->description : '' }}</textarea>
            </div>
            <div class="row">
                <div class="col-6" class="form-group">
                    <label for="example-tel-input" class="form-control-label">File</label>
                    <input class="form-control" name="file" type="file" onchange="changeImage(event)">
                </div>
                <div class="col-6" class="form-group">
                    <label for="example-tel-input" class="form-control-label">This countris is block for free
                        account</label>
                    <select name="is_blocked" class="form-control">
                        @foreach ($countryStatus::STATUS_BLOCK as $item)
                            <option value="{{ $item['status'] }}"
                                {{ isset($country) && $country->is_blocked == $item['status'] ? 'selected' : ' ' }}>
                                {{ $item['text'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if (isset(Session::get('errors')['file']))
                <div class="col-md-4 form-group">
                    @include('components.alert', $data = Session::get('errors')['file'])
                </div>
            @endif

            <div class="form-group">
                <label for="example-tel-input" class="form-control-label">Preview</label>
                <img class="form-control" id="preview-img" class="col-6 img-thumbnail" style="width: 40rem" alt=""
                    src="{{ isset($country) ? getS3Url($country->image) : '' }}">
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
