<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businesses = Business::all();
        return view('businesses.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('businesses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:businesses',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $business = Business::create([
            'name' => $request->name,
            'code' => $request->code,
            'is_active' => true,
            'contact_number' => $request->contact_number,
            'address' => $request->address
        ]);

        if ($request->hasFile('logo')) {
            $business->addMediaFromRequest('logo')
                ->toMediaCollection('business-logo');
        }

        if ($business instanceof Model) {
            toastr()->success('Business has been created successfully!');
            return redirect()->route('businesses.index');
        }

        toastr()->error('An error has occurred please try again later.');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $business = Business::findOrFail($id);
        return view('businesses.show', compact('business'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $business = Business::findOrFail($id);
        return view('businesses.edit', compact('business'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:businesses,code,' . $id,
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $business = Business::findOrFail($id);
        $business->update([
            'name' => $request->name,
            'code' => $request->code,
            'contact_number' => $request->contact_number,
            'address' => $request->address
        ]);

        if ($request->hasFile('logo')) {
            $business->addMediaFromRequest('logo')
                ->toMediaCollection('business-logo');
        }

        toastr()->success('Business has been updated successfully!');
        return redirect()->route('businesses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $business = Business::findOrFail($id);
        $business->delete();

        return redirect()->route('businesses.index')
            ->with('success', 'Business deleted successfully.');
    }
}
