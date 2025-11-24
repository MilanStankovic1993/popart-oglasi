<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ads = Ad::with(['user', 'category'])
            ->latest()
            ->paginate(15);

        return view('admin.ads.index', compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        $customers = User::where('id', '!=', auth()->id())
            ->orderBy('name')
            ->get();

        return view('admin.ads.create', compact('categories', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'condition'   => ['required', 'in:novo,polovno'],
            'phone'       => ['required', 'string', 'max:50'],
            'location'    => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'user_id'     => ['required', 'exists:users,id'],
            'image'       => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('ads', 'public');
        }

        Ad::create($validated);

        return redirect()
            ->route('admin.ads.index')
            ->with('success', 'Oglas je uspešno kreiran.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ad $ad)
    {
        $categories = Category::orderBy('name')->get();

        $customers = User::where('id', '!=', auth()->id())
            ->orderBy('name')
            ->get();

        return view('admin.ads.edit', compact('ad', 'categories', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ad $ad)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'condition'   => ['required', 'in:novo,polovno'],
            'phone'       => ['required', 'string', 'max:50'],
            'location'    => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'user_id'     => ['required', 'exists:users,id'],
            'image'       => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($ad->image) {
                Storage::disk('public')->delete($ad->image);
            }
            $validated['image'] = $request->file('image')->store('ads', 'public');
        }

        $ad->update($validated);

        return redirect()
            ->route('admin.ads.index')
            ->with('success', 'Oglas je uspešno ažuriran.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ad $ad)
    {
        if ($ad->image) {
            Storage::disk('public')->delete($ad->image);
        }

        $ad->delete();

        return redirect()
            ->route('admin.ads.index')
            ->with('success', 'Oglas je obrisan.');
    }
}
