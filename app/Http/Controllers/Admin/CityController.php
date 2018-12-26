<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use App\Repositories\CityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CityController extends AppBaseController
{
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
        $this->defaultLocale = 'ru';
    }

    public function index(Request $request)
    {
        $this->cityRepository->pushCriteria(new RequestCriteria($request));
        $cities = $this->cityRepository->paginate(10);

        return view('admin.cities.index')
            ->with('cities', $cities);
    }

    public function create()
    {
        $locales = config('translatable.locales');

        return view('admin.cities.create', compact('locales'));
    }

    public function store(CreateCityRequest $request)
    {
    //print_r($request);die();
        $request->merge([
            'user_id' => auth()->id()
        ]);

        $input = $request->except(['_token']);

        $city = $this->cityRepository->create($input);

        Flash::success('City saved successfully.');

        return redirect(route('cities.index'));
    }

    public function show($id){}

    public function edit($id)
    {
        $locales = config('translatable.locales');

        $city = $this->cityRepository->findWithoutFail($id);

        if (empty($city)) {
            Flash::error('city not found');

            return redirect(route('cities.index'));
        }

        return view('admin.cities.edit', compact('locales', 'city'));
    }

    public function update($id, UpdateCityRequest $request)
    {
        $city = $this->cityRepository->findWithoutFail($id);

        if (empty($city)) {
            Flash::error('city not found');

            return redirect(route('cities.index'));
        }

        $input = $request->except(['_token']);

        $city = $this->cityRepository->update($input, $id);

        foreach( LaravelLocalization::getSupportedLocales() as $locale => $properties ) {

            $translation_id = $city->translate($locale)->id;
        }

        Flash::success('city updated successfully.');

        return redirect(route('cities.index'));
    }


    public function destroy($id)
    {
        $city = $this->districtRepository->findWithoutFail($id);

        if (empty($city)) {
            Flash::error('City not found');
            return redirect(route('cities.index'));
        }

        $this->cityRepository->delete($id);

        Flash::success('City deleted successfully.');

        return redirect(route('cities.index'));
    }
}
