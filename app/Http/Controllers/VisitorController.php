<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::with(['subCategory','subCategory.category'])->get();
        $countServices = Service::count();
        return view('visitors.index', compact('services', 'countServices'));
    }

    public function singleService($id)
    {
        $services = Service::findOrFail($id);
        $countRate = Rating::where('service_id', $services->id)->count();
        $subcategoryId = $services->sub_category_id;
        $subcategory = SubCategory::where('id', $subcategoryId)->first();
        $category = Category::where('id', $subcategory->category_id)->first();
        $suggests = Service::whereHas('subCategory', function ($query) use ($category) {
              $query->where('category_id', $category->id);
        })->with(['subCategory'])->orderBy('id', 'DESC')
        ->paginate('10');
        return view('single-service', compact('services', 'category', 'suggests', 'countRate'));
    }

    public function link($slug)
    {
        $services = Service::findOrFail($slug);
        $subcategoryId = $services->sub_category_id;
        $subcategory = SubCategory::where('id', $subcategoryId)->first();
        $category = Category::where('id', $subcategory->category_id)->first();
        $suggests = Service::whereHas('subCategory', function ($query) use ($category){
              $query->where('category_id', $category->id);
        })->with(['subCategory'])->orderBy('id', 'DESC')
        ->paginate('10');
        return view('single-service', compact('services', 'category', 'suggests'));
    }
   
}
