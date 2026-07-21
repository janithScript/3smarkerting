<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Distributor;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->active()
            ->latest()
            ->take(8)
            ->get();

        $latestNews = News::with('category')
            ->active()
            ->latest()
            ->take(6)
            ->get();

        $galleryImages = Gallery::latest()->take(8)->get();

        $distributors = Distributor::latest()->take(6)->get();

        $companySetting = CompanySetting::first();

        return view('pages.home', compact(
            'featuredProducts',
            'latestNews',
            'galleryImages',
            'distributors',
            'companySetting'
        ));
    }

    public function about()
    {
        $companySetting = CompanySetting::first();
        return view('pages.about', compact('companySetting'));
    }
}
