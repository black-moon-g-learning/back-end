@extends('layouts.master')

@section('content')
    <style>
        .card-footer,
        .progress {
            display: none;
        }
    </style>
    <div class="p-4 bg-secondary">
        <form enctype="multipart/form-data"
            action="{{ isset($video) ? route('web.videos.update', $video->id) : route('web.videos.store') }}" method="POST">

            @csrf

            @isset($video)
                @method('PUT')
            @endisset

            <input name="country_topic_id" type="hidden"
                value="{{ isset($video) ? $video->country_topic_id : $countryTopicId }}" />

            <div class="row">
                <div class="form-group col-6">
                    <label for="example-text-input" class="form-control-label">Name</label>
                    <input class="form-control" name="name" type="text"
                        value="{{ isset($video) ? $video->name : '' }}" id="example-text-input">
                    @if (isset(Session::get('errors')['name']))
                        <div class=" form-group">
                            @include('components.alert', $data = Session::get('errors')['name'])
                        </div>
                    @endif
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Author</label>
                        <input readonly class="form-control" type="text" name="total video"
                            value="{{ (isset($video) ? getUsername($video->user) : isset($user)) ? getUsername($user) : '' }}"
                            id="example-search-input">
                    </div>
                    @if (isset(Session::get('errors')['regions']))
                        <div class="form-group">
                            @include('components.alert', $data = Session::get('errors')['total video'])
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="example-search-input" class="form-control-label">Duration</label>
                        <input class="form-control" type="number" name="time"
                            value="{{ isset($video) ? $video->time : '' }}" id="example-search-input">
                        @if (isset(Session::get('errors')['time']))
                            <div class="form-group">
                                @include('components.alert', $data = Session::get('errors')['time'])
                            </div>
                        @endif
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
                        <div class="form-group">
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

            @if (!isset($video))
                <div class="row">
                    <div class="col-6">
                        <label for="example-tel-input" class="form-control-label">Video</label>
                        <input class="form-control" id="youtube_url" name="video_url" type="text"
                            onchange="changeImage(event)">
                        @if (isset(Session::get('errors')['video_url']))
                            <div class="form-group">
                                @include('components.alert', $data = Session::get('errors')['video_url'])
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-6">
                    <div class=" text-center">
                        <h5>Upload File</h5>
                    </div>

                    <div id="upload-container" class="text-center">
                        <button type="button" id="browseFile" class="btn btn-primary">Browse File</button>
                    </div>
                    <div class="progress mt-3" style="height: 25px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">
                            75%</div>
                    </div>
                </div>
            @endif
            <br />
            <div class="form-group ">
                <div class="col-6">
                    <input class="btn btn-success" type="submit" value="Submit">
                </div>
            </div>
        </form>

    </div>
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

@section('customJs')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!-- Resumable JS -->
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: "{{ route('web.videos.upload') }}",
            query: {
                _token: '{{ csrf_token() }}'
            }, // CSRF token
            fileType: ['mp4'],
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function() { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function(file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
            response = JSON.parse(response)
            if (response.status) {
                $('.card-footer').show();
                $("#youtube_url").val(response.path);
                $("#youtube_url").attr('readonly', true);
                alert('upload video successful');
            } else {
                alert('can not video!');
            }

        });

        resumable.on('fileError', function(file, response) { // trigger when there is any error
            alert('file uploading error.')
        });


        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>
@endsection
