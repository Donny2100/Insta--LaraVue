<div class="modal fade" id="modal_add_state" tabindex="-1" role="dialog" aria-labelledby="modal_add_state" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add State</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <form action="{{route('admin_state_create')}}" method="post" data-parsley-validate>
                <input type="hidden" id="add_state_method" name="_method" value="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">State name: *</label>
                                <input type="text" class="form-control" id="state_name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="name">State slug: *</label>
                                <input type="text" class="form-control" id="state_slug" name="slug" required>
                            </div>
                            <div class="form-group">
                                <label for="country_id">Country: *</label>
                                <select class="form-control" id="country_id" name="country_id" required>
                                    <option value="" hiddel>-- Select a country --</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" id="state_id" name="state_id" value="1">
                    <button type="submit" class="btn btn-primary" id="submit_add_state">Add</button>
                    <button class="btn btn-primary" id="submit_edit_state">Save</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>

            </form>

        </div>
    </div>
</div>
