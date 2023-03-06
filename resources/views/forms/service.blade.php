@extends('layouts.master')

@section('content')
    <div class="p-4 bg bg-secondary">
        <form action="{{ route('web.services.update', $service->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Name</label>
                <input class="form-control" name="name" type="text" value="{{ isset($service) ? $service->name : '' }}"
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
                        <label for="example-search-input" class="form-control-label">Price</label>
                        <input class="form-control" type="number" name="price"
                            value="{{ isset($service) ? $service->price : '' }}" id="example-search-input">
                    </div>
                    @if (isset(Session::get('errors')['price']))
                        <div class="form-group">
                            @include('components.alert', $data = Session::get('errors')['price'])
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="example-url-input" class="form-control-label">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ isset($service) ? $service->description : '' }}</textarea>
            </div>
            <input class="btn btn-success" type="submit" value="Submit">
        </form>
    </div>
@endsection
