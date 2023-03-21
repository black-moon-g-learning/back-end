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
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Topic</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($remainTopics->toArray()['data'] as $remainTopic)
                                                    <tr>
                                                        <td>
                                                            <h6 class="modal-title" id="modal-title-default">
                                                                {{ $remainTopic['name'] }}</h6>
                                                        </td>
                                                        <td>
                                                            <img class="modal-title" style="width:150px"
                                                                src={{ getS3Url($remainTopic['image']) }}
                                                                id="modal-title-default" />
                                                        </td>
                                                        <td>
                                                            <form method="POST"
                                                                action="{{ route('web.countries-topics.store', $country->id) }}">
                                                                @csrf
                                                                <input type="hidden" name='topic_id'
                                                                    value="{{ $remainTopic['id'] }}" />
                                                                <button class="modal-title create-topic btn btn-primary"
                                                                    id="modal-title-default">
                                                                    Add</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

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
