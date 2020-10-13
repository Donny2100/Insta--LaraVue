@extends('admin.layouts.template')

@section('main')

    <div class="page-title">
        <div class="title_left">
            <h3>States</h3>
        </div>
        <div class="title_right">
            <div class="pull-right">
                <button class="btn btn-primary" id="btn_add_state" type="button">+ Add State</button>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Select Country:</label>
                            <form>
                                <select class="form-control" id="select_country_id" name="country_id" onchange="this.form.submit()">
                                    <option value="">All countries</option>
                                    @foreach($countries as $country)
                                        @if($country_id)
                                            <option value="{{$country->id}}" {{isSelected($country->id, $country_id)}}>{{$country->name}}</option>
                                        @else
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content table-responsive">
                    <table class="table table-striped table-bordered golo-datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>State Name</th>
                            <th>Cities</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($states as $state)
                            <tr>
                                <td>{{$state->id}}</td>
                                <td>{{$state->name}}</td>
                                <td>{{$state->cities_count}}</td>
                                <td>{{$state->country->name}}</td>
                                <td>
                                    <input type="checkbox" class="js-switch state_status" data-id="{{$state->id}}" {{isChecked($state->status, 1)}}/>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-xs state_edit"
                                            data-id="{{$state->id}}"
                                            data-name="{{$state->name}}"
                                            data-slug="{{$state->slug}}"
                                            data-country="{{$state->country->id}}"
                                    >Edit
                                    </button>
                                    <form class="d-inline" action="{{route('admin_state_delete',$state->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-xs state_delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @include('admin.state.modal_add_state
    ')
@stop

@push('scripts')
    <script src="{{asset('admin/js/page_state.js')}}"></script>
@endpush
