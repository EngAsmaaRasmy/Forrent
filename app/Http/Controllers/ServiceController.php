<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CustomerServiceFavorite;
use App\Models\Rating;
use App\Models\SearchLog;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Traits\SlugTrait;
use App\Traits\TranslationTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Validator;

class ServiceController extends Controller
{
    use ApiResponser;
    use SlugTrait;
    use TranslationTrait;

    /**
     * Display a listing of the resource.
     *
     * @return list of services
     */
    public function index()
    {
        $service_provider_id = session('id');
        $services = Service::where('service_provider_id', $service_provider_id)->get();
        return view('serviceproviders.services.index', compact('services'));
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \ Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service_provider = ServiceProvider::where('token', session('token'))->first();
        if ($service_provider && $service_provider->token != null) {
            $request->validate([
                'title' => 'required|regex:/^[a-zA-Z]/',
                'title_ar' => 'required',
                'description_ar' => 'required',
                'description' => 'required|regex:/^[a-zA-Z]/',
                'discount' => 'nullable',
                'discount_period' => 'nullable',
                'price' => 'required|regex:/(^[1-9])/',
                'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:width:280,height:280',
            ]);
            $data = [
                'title' => $request->input('title'),
                'title_ar' => $request->input('title_ar'),
                'description' => $request->input('description'),
                'description_ar' => $request->input('description_ar'),
                'price' => $request->input('price'),
                'period_unit' => $request->input('period_unit'),
                'discount' => $request->input('discount'),
                'discount_period' => $request->input('discount_period'),
                'start_data' => $request->input('start_data'),
                'end_data' => $request->input('end_data'),
                'area_id' => $request->input('area_id'),
                'sub_category_id' => $request->input('sub_category_id'),
                // 'disabled' => $request->input('disabled'),
                'service_provider_id' => session('id')
            ];
            $uploads_folder =  getcwd() . '/uploads/';
            if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
            }
            $service = Service::create($data);
            if ($request->input('disabled')) {
                 $service->disabled = ($service->disabled == 0 ? 1 : 0);
            }
            $input['slug'] = $this->createSlug('Service', $service->id, $service->title, 'services');
            if ($request->file('image')) {
                    $image_name = md5($service->id . "app" . $service->id . rand(1, 1000));
                    $image_ext = $request->file('image')->getClientOriginalExtension(); // example: png, jpg ... etc
                    $image_full_name = $image_name . '.' . $image_ext;
                    $request->file('image')->move($uploads_folder, $image_name  . '.' . $image_ext);
                    $service->image =  $image_full_name;
            }
            $service->save();
            $this->translate($request, 'Service', $service->id);
            return redirect()->back()->with('message', trans('main.add_service'));
        } else {
            return view('login');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $Validator = $request->validate([
            'title' => 'required',
            'discount' => 'nullable|regex:/(^[0-9])?%/',
            'price' => 'regex:/(^[1-9])/',
            'image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:width:280,height:280',
        ]);

        $service = Service::find($id);
        $this->editSlug('Service', $service->id, $service->title, 'services');
        $service->update($input);

        $uploads_folder =  getcwd() . '/uploads/';

        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }

        if ($request->file('image')) {
            $image_name = md5($service->id . "app" . $service->id . rand(1, 1000));

            $image_ext = $request->file('image')->getClientOriginalExtension(); // example: png, jpg ... etc

            $image_full_name = $image_name . '.' . $image_ext;

            $request->file('image')->move($uploads_folder, $image_name  . '.' . $image_ext);

            $service->image =  $image_full_name;
        }
        $service->save();
        session()->flash('edit');
        return redirect()->back()->with('message', trans('main.edit_service'));
    }
    public function destroy($id)
    {
        $service = Service::find($id);
        $favorite = CustomerServiceFavorite::where('service_id', $id)->get();
        if (count($favorite) > 0) {
            $favorite->delete();
        }
        $rate = Rating::where('service_id', $id)->get();
        if (count($rate) > 0) {
            $rate->delete();
        }
        if ($service->image) {
            File::delete(public_path() . "/uploads/" . $service->image);
        }
        $service->delete();
        session()->flash('delete');
        return redirect()->back()->with('message', trans('main.delete_service'));
    }
    public function search(Request $request)
    {
        $categoryId = $request->input('category_id');
        $areaId = $request->input('area_id');
        $search = $request->input('search');
        if ($search) {
                $searchLog = SearchLog::create([
                    'input' => $search
                ]);
        }
        if ($categoryId == null && $areaId == null) {
            $services = Service::orderby('created_at', 'DESC')->with('area', 'subCategory.category')->get();
            if ($services) {
                $services = $services->collect()->filter(function ($service) use ($search) {
                    if (
                        Str::contains(strtolower($service->title), strtolower($search)) ||
                        Str::contains($service->title_ar, $search)
                    ) {
                        if (app()->getlocale() == 'ar') {
                            $service->title = $service->title_ar;
                            $service->description = $service->description_ar;
                        }
                        return $service;
                    }
                });
            }
            return view('visitors.search', compact('services'));
        } elseif ($categoryId != null && $areaId == null && $search != null) {
            $services = Service::whereHas('subCategory', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })->with('area', 'subCategory.category')->get();
            if ($services) {
                $services = $services->collect()->filter(function ($service) use ($search) {
                    if (
                        Str::contains(strtolower($service->title), strtolower($search)) ||
                        Str::contains($service->title_ar, $search)
                    ) {
                        if (app()->getlocale() == 'ar') {
                            $service->title = $service->title_ar;
                            $service->description = $service->description_ar;
                        }
                        return $service;
                    }
                });
            }
            return view('visitors.search', compact('services'));
        } elseif ($categoryId != null && $areaId != null && $search != null) {
            $services = Service::whereHas('subCategory', function ($query) use ($categoryId, $areaId) {
                $query->Where('category_id', $categoryId)->where('area_id', $areaId);
            })->with('area', 'subCategory.category')->get();
            if ($services) {
                $services = $services->collect()->filter(function ($service) use ($search) {
                    if (
                        Str::contains(strtolower($service->title), strtolower($search)) ||
                        Str::contains($service->title_ar, $search)
                    ) {
                        if (app()->getlocale() == 'ar') {
                            $service->title = $service->title_ar;
                            $service->description = $service->description_ar;
                        }
                        return $service;
                    }
                });
            }
            return view('visitors.search', compact('services'));
        } elseif ($categoryId == null && $areaId != null && $search != null) {
            $services = Service::whereHas('area', function ($query) use ($areaId) {
                $query->where('area_id', $areaId);
            })->with('area', 'subCategory.category')->get();
            if ($services) {
                $services = $services->collect()->filter(function ($service) use ($search) {
                    if (
                        Str::contains(strtolower($service->title), strtolower($search)) ||
                        Str::contains($service->title_ar, $search)
                    ) {
                        if (app()->getlocale() == 'ar') {
                            $service->title = $service->title_ar;
                            $service->description = $service->description_ar;
                        }
                        return $service;
                    }
                });
            }
            return view('visitors.search', compact('services'));
        } elseif ($categoryId == null && $areaId != null && $search == null) {
            $services = Service::whereHas('area', function ($query) use ($areaId) {
                $query->where('area_id', $areaId);
            })->with('area', 'subCategory.category')->get();
            return view('visitors.search', compact('services'));
        } elseif ($categoryId != null && $areaId == null && $search == null) {
            $services = Service::whereHas('subCategory', function ($query) use ($categoryId) {
                $query->Where('category_id', $categoryId);
            })->with('area', 'subCategory.category')->get();
            return view('visitors.search', compact('services'));
        } elseif ($categoryId != null && $areaId != null && $search == null) {
            $services = Service::whereHas('subCategory', function ($query) use ($categoryId, $areaId) {
                $query->Where('category_id', $categoryId)->where('area_id', $areaId);
            })->with('area', 'subCategory.category')->get();
            return view('visitors.search', compact('services'));
        }
    }

    public function mobileSearch(Request $request)
    {

        $search = $request->input('mobile-search');
        $searchLog = SearchLog::create([
            'input' => $search,
        ]);
        $services = Service::orderby('created_at', 'DESC')->with('area', 'subCategory.category')->get();
        $services = $services->collect()->filter(function ($service) use ($search) {
            if (
                    Str::contains(strtolower($service->title), strtolower($search)) ||
                    Str::contains($service->title_ar, $search)
            ) {
                if (app()->getlocale() == 'ar') {
                       $service->title = $service->title_ar;
                       $service->description = $service->description_ar;
                }
                return $service;
            }
        });
         return view('visitors.search', compact('services'));
    }

    public function filter(Request $request)
    {
        $filter_price = $request->input('price');
        $filter_category = $request->get('category_id');
        $filter_area = $request->get('area_id');
        if ($filter_price != null && $filter_area == null && $filter_category == null) {
            $services = Service::query()
            ->where('price', 'LIKE', "%{$filter_price}%")
            ->with('area.city', 'subCategory.category')->get();
            return view('visitors.filter', compact('services'));
        } elseif ($filter_category != null && $filter_area == null && $filter_price == null) {
            $services = Service::whereHas('subCategory', function ($query) use ($filter_category) {
                $query->whereIn('category_id', $filter_category);
            })->with('area.city', 'subCategory.category')->orderby('created_at', 'DESC')->get();
            return view('visitors.filter', compact('services'));
        } elseif ($filter_area != null  && $filter_category == null && $filter_price == null) {
            $services = Service::with('area')->whereIn('area_id', $filter_area)->with('area.city', 'subCategory.category')->orderby('created_at', 'DESC')->get();
            return view('visitors.filter', compact('services'));
        } elseif ($filter_area != null || $filter_category != null || $filter_price != null) {
            $services = Service::whereHas('subCategory', function ($query) use ($filter_category, $filter_area, $filter_price) {
                $query->where('category_id', $filter_category);
                $query->whereIn('area_id', $filter_area);
                $query->where('price', 'LIKE', "%{$filter_price}%");
            })->with('area.city', 'subCategory.category')->orderby('created_at', 'DESC')->get();
            return view('visitors.filter', compact('services'));
        } else {
            return back();
        }
    }
    public function categoryServices($id)
    {

         $category = Category::findOrFail($id);
         $services = Service::whereHas('subCategory', function ($query) use ($category) {
            $query->where('category_id', $category->id);
         })
        ->with('area.city', 'subCategory.category')->orderBy('id', 'DESC')->select('*', 'services.id as me_id')->get();
        return view('visitors.category', compact('services', 'category'));
    }
    public function subCategoryServices($id)
    {

        $sub_category = SubCategory::findOrFail($id);
        $services = Service::with('subCategory')
        ->where('sub_category_id', $sub_category->id)
        ->select('*', 'services.id as me_id')
        ->get();
        return view('visitors.filter', compact('services'));
    }
}
