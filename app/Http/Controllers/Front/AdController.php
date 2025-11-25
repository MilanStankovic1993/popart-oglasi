<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        $ads = $this->buildAdsQuery($request)
            ->paginate(9)
            ->withQueryString();

        return view('front.ads.index', [
            'ads'             => $ads,
            'categories'      => $categories,
            'currentCategory' => null,
            'filters'         => $this->extractFilters($request),
        ]);
    }

    public function category(Request $request, Category $category)
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        $categoryIds = $this->getCategoryIdsWithDescendants($category);

        $ads = $this->buildAdsQuery($request)
            ->whereIn('category_id', $categoryIds)
            ->paginate(9)
            ->withQueryString();

        return view('front.ads.index', [
            'ads'             => $ads,
            'categories'      => $categories,
            'currentCategory' => $category,
            'filters'         => $this->extractFilters($request),
        ]);
    }

    public function show(Ad $ad)
    {
        $ad->load('category', 'user');

        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        return view('front.ads.show', [
            'ad'              => $ad,
            'categories'      => $categories,
            'currentCategory' => $ad->category,
        ]);
    }

    /** FILTERS + SORT */
    protected function buildAdsQuery(Request $request)
    {
        $query = Ad::with('category', 'user');

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($location = $request->input('location')) {
            $query->where('location', 'like', "%{$location}%");
        }

        if ($condition = $request->input('condition')) {
            $query->where('condition', $condition);
        }

        if ($minPrice = $request->input('min_price')) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice = $request->input('max_price')) {
            $query->where('price', '<=', $maxPrice);
        }

        // SORT
        switch ($request->input('sort')) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;

            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;

            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            default:
                $query->orderBy('created_at', 'desc');
        }

        return $query;
    }

    protected function extractFilters(Request $request): array
    {
        return [
            'q'         => $request->input('q'),
            'location'  => $request->input('location'),
            'condition' => $request->input('condition'),
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),
            'sort'      => $request->input('sort'),
        ];
    }

    /** Rekurzivno izvlačenje ID potomaka */
    protected function getCategoryIdsWithDescendants(Category $category): array
    {
        $ids = [$category->id];

        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->getCategoryIdsWithDescendants($child));
        }

        return $ids;
    }
}
