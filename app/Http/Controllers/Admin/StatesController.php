<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class StatesController extends Controller {
    public function index(Request $request) {
        $param_country_id = $request->country_id;
        $countries        = Country::all();
        $states           = State::whereHas('country', function($q) use ($param_country_id) {
            if ($param_country_id) {
                $q->where('id', $param_country_id);
            }
        })->with('country')->withCount('cities')->get();

        return view('admin.state.state_list', [
            'countries' => $countries,
            'states' => $states,
            'country_id' => $param_country_id
        ]);
    }

    public function getStatesByCountry(Request $request) {
        $states = State::whereHas('country', function($q) use ($request) {
            $q->where('id', $request->country_id);
        })->with('country')->withCount('cities')->get();

        return response()->json(['code' => 200, 'data' => $states], 200);
    }

    public function create(Request $request) {
        try {
            State::create([
                'name' => $request->name,
                'slug' => Str::slug($request->slug, '-'),
                'country_id' => $request->country_id,
            ]);
            return back()->with('success', 'State created successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', 'something went wrong');
        }
    }

    public function update(Request $request) {
        $model = State::find($request->state_id);

        if ($model->update($request->all())) {
            return back()->with('success', 'State updated successfully!');
        }
    }

    public function updateStatus(Request $request) {
        $data = $this->validate($request, ['status' => 'required']);

        $model = State::find($request->state_id);

        if ($model->update($data)) {
            return response()->json(['code' => 200, 'message' => 'State updated succesfully!'], 200);
        }
    }

    public function destroy($id) {
        State::destroy($id);
        return redirect()->route('admin_state_list')->with('success', 'State deleted successfully!');
    }
}
