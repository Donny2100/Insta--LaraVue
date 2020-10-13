<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Amenities;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AmenitiesController extends Controller {
    private $amenities;

    public function __construct(Amenities $amenities) {
        $this->amenities = $amenities;
    }

    public function list() {
        $amenities = $this->amenities->getListAll();

        return view('admin.amenities.amenities_list', [
            'amenities' => $amenities
        ]);
    }

    public function create(Request $request) {
        $rule_factory = RuleFactory::make([
            '%name%' => ''
        ]);
        $data = $this->validate($request, $rule_factory);

        if ($request->hasFile('icon')) {
            $data['icon'] = Storage::put('ameneties', $request->file('icon'), 'public');
        }

        $model = new Amenities();
        $model->fill($data)->save();

        return back()->with('success', 'Add amenities success!');
    }

    public function update(Request $request) {
        $rule_factory = RuleFactory::make([
            'amenities_id' => 'required',
            '%name%' => ''
        ]);
        $data = $this->validate($request, $rule_factory);

        if ($request->hasFile('icon')) {
            $data['icon'] = Storage::put('ameneties', $request->file('icon'), 'public');
        }

        $model = Amenities::findOrFail($request->amenities_id);
        $model->fill($data)->save();

        return back()->with('success', 'Update amenities success!');
    }

    public function destroy($id) {
        Amenities::destroy($id);
        return back()->with('success', 'Delete amenities success!');
    }
}
