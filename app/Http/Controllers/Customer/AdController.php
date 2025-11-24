<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('customer.ads.create', compact('categories'));
    }

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
            'image'       => ['nullable', 'image', 'max:2048'],
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('ads', 'public');
        }

        Ad::create($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Oglas je uspešno kreiran.');
    }

    public function edit(Ad $my_ad)
    {
        if ($my_ad->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::orderBy('name')->get();

        return view('customer.ads.edit', [
            'ad' => $my_ad,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Ad $my_ad)
    {
        if ($my_ad->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'condition'   => ['required', 'in:novo,polovno'],
            'phone'       => ['required', 'string', 'max:50'],
            'location'    => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'image'       => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($my_ad->image) {
                Storage::disk('public')->delete($my_ad->image);
            }

            $validated['image'] = $request->file('image')->store('ads', 'public');
        }

        $my_ad->update($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Oglas je uspešno ažuriran.');
    }

    public function destroy(Ad $my_ad)
    {
        if ($my_ad->user_id !== Auth::id()) {
            abort(403);
        }

        if ($my_ad->image) {
            Storage::disk('public')->delete($my_ad->image);
        }

        $my_ad->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Oglas je obrisan.');
    }

    public function show()
    {
        abort(404);
    }
}
