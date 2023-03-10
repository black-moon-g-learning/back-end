<div class="col-md-4">
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-info text-gradient">Add new topic</h3>
                            <p class="mb-0">Press Add to add new topic for country</p>
                        </div>
                        <div class="card-body">
                            <div role="form text-left">
                                <div class="modal-content">
                                    @if (!empty($remainTopics->toArray()['data']))
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Topic</h6>
                                            <h6 class="modal-title" id="modal-title-default">Image</h6>
                                            <h6 class="modal-title" id="modal-title-default">Action</h6>

                                        </div>

                                        @foreach ($remainTopics->toArray()['data'] as $remainTopic)
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="modal-title-default">
                                                    {{ $remainTopic['name'] }}</h6>
                                                <img class="modal-title" style="width:150px"
                                                    src={{ getS3Url($remainTopic['image']) }}
                                                    id="modal-title-default" />
                                                <form method="POST"
                                                    action="{{ route('web.countries-topics.store', $country->id) }}">
                                                    @csrf
                                                    <input type="hidden" name='topic_id'
                                                        value="{{ $remainTopic['id'] }}" />
                                                    <button class="modal-title btn btn-primary"
                                                        id="modal-title-default">
                                                        Add</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
