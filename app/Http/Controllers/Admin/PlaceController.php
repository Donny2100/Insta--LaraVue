<?php

namespace App\Http\Controllers\Admin;


use App\Commons\Response;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Amenities;
use App\Models\Place;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    private $place;
    private $country;
    private $city;
    private $category;
    private $amenities;
    private $response;

    public function __construct(
        Place $place,
        Country $country,
        City $city,
        Category $category,
        Amenities $amenities,
        Response $response
    )
    {
        $this->place = $place;
        $this->country = $country;
        $this->city = $city;
        $this->category = $category;
        $this->amenities = $amenities;
        $this->response = $response;
    }

    public function list(Request $request) {
        $param_country_id = $request->country_id;
        $param_city_id = $request->city_id;
        $param_cat_id = $request->category_id;
        $param_state_id = $request->state_id;

        $countries = $this->country->getFullList();
        $categories = $this->category->getListAll(Category::TYPE_PLACE);

        $places = $this->place->whereHas('city', function($q) use ($request) {
            if ($request->city_id) {
                $q->where('id', $request->city_id);
            }
        })
        ->paginate(50);

        return view('admin.place.place_list', [
            'places' => $places,
            'countries' => $countries,
            'country_id' => $param_country_id,
            'city_id' => $param_city_id,
            'categories' => $categories,
            'state_id' => $param_state_id,
        ]);
    }

    public function createView(Request $request)
    {
        $place = Place::find($request->id);
        $country_id = $place ? $place->country_id : false;

        $countries = $this->country->getFullList();
        $categories = $this->category->getListAll(Category::TYPE_PLACE);
        $cities = $this->city->getListByCountry($country_id);

        $place_types = Category::query()
            ->with('place_type')
            ->get();

        $amenities = $this->amenities->getListAll();

        return view('admin.place.place_create', compact('countries', 'cities', 'categories', 'place_types', 'amenities', 'place'));
    }

    public function create(Request $request) {
        $request['user_id'] = Auth::id();
        $request['slug'] = getSlug($request, 'name');
        $rule_factory = RuleFactory::make([
            'user_id' => '',
            'country_id' => '',
            'city_id' => '',
            'category' => '',
            'place_type' => '',
            '%name%' => '',
            'slug' => '',
            'state_id' => 'required|integer',
            '%description%' => '',
            'price_range' => '',
            'amenities' => '',
            'address' => '',
            'lat' => '',
            'lng' => '',
            'email' => '',
            'phone_number' => '',
            'website' => '',
            'social' => '',
            'opening_hour' => '',
            'gallery' => '',
            'video' => '',
            'booking_type' => '',
            'link_bookingcom' => '',
            'thumb' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'seo_title' => '',
            'seo_description' => ''
        ]);
        $data = $this->validate($request, $rule_factory);

        $data['booking_type'] = \App\Models\Booking::TYPE_CONTACT_FORM;

        if ($request->hasFile('thumb')) {
            $data['thumb'] = Storage::put('place', $request->file('thumb'), 'public');
        }

        $model = new Place();
        $model->fill($data);

        if ($model->save()) {
            return redirect(route('admin_place_list'))->with('success', 'Create place success!');
        }

    }

    public function update(Request $request)
    {
        $request['slug'] = getSlug($request, 'name');
        $rule_factory = RuleFactory::make([
            'country_id' => '',
            'city_id' => '',
            'category' => '',
            'place_type' => '',
            '%name%' => '',
            'slug' => '',
            '%description%' => '',
            'price_range' => '',
            'amenities' => '',
            'address' => '',
            'lat' => '',
            'lng' => '',
            'email' => '',
            'phone_number' => '',
            'website' => '',
            'social' => '',
            'opening_hour' => '',
            'gallery' => '',
            'video' => '',
            'booking_type' => '',
            'link_bookingcom' => '',
            'thumb' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'seo_title' => '',
            'seo_description' => ''
        ]);
        $data = $this->validate($request, $rule_factory);

        $data['booking_type'] = \App\Models\Booking::TYPE_CONTACT_FORM;

        if ($request->hasFile('thumb')) {
            $data['thumb'] = Storage::put('place', $request->file('thumb'), 'public');
        }

        $model = Place::find($request->place_id);
        $model->fill($data);

        if ($model->save()) {
            return redirect(route('admin_place_list'))->with('success', 'Update place success!');
        }
    }

    public function updateStatus(Request $request)
    {
        $data = $this->validate($request, [
            'status' => 'required',
        ]);

        $model = Place::find($request->place_id);
        $model->fill($data)->save();

        return $this->response->formatResponse(200, $model, 'Update place status success!');
    }

    public function destroy($id)
    {
        Place::destroy($id);
        return back()->with('success', 'Delete place success!');
    }
}
