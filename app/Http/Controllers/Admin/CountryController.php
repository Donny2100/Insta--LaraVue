<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private $country;

    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    /**
     * Get list country
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $countries = Country::all();

        return view('admin.country.country_list', [
            'countries' => $countries
        ]);
    }

    /**
     * Create country
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
        ]);
        $model = new Country();
        $model->fill($data)->save();

        return redirect()->route('admin_country_list')->with('success', 'Add country success!');
    }

    /**
     * Update country
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $data = $this->validate($request, [
            'country_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
        ]);

        $model = Country::findOrFail($request->country_id);
        $model->fill($data);

        if ($model->save())
            return redirect()->route('admin_country_list')->with('success', 'Update country success!');
        else
            return redirect()->route('admin_country_list')->with('error', 'Update country fail!');
    }

    public function updateStatus(Request $request) {
        $data = $this->validate($request, ['status' => 'required']);

        $model = Country::find($request->country_id);

        if ($model->update($data)) {
            return response()->json(['code' => 200, 'message' => 'Country updated succesfully!'], 200);
        }
    }

    /**
     * Delete country
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Country::destroy($id);
        return redirect()->route('admin_country_list')->with('success', 'Delete country success!');
    }
}
