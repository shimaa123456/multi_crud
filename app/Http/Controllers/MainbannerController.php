<?php

namespace App\Http\Controllers;

use App\Models\Mainbanner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MainbannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mainbanners = Mainbanner::latest()->paginate(5);

        return view('mainbanner.index', compact('mainbanners'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mainbanner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png,svg',
        ]);

        $photo = $request->file("photo");
        $storedPhotoName = time() . $request->photo->getClientOriginalName();
        $photo->move(public_path("bannerPhotos"), $storedPhotoName);

        $mainbanner = new Mainbanner();
        $mainbanner->title = $request->title;
        $mainbanner->description = $request->description;
        $mainbanner->photo = $storedPhotoName;

        $mainbanner->save();

        return redirect()->route('mainbanner.index')->with('success', 'Banner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mainbanner $mainbanner)
    {
        return view('mainbanner.show', compact('mainbanner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mainbanner $mainbanner)
    {
        return view('mainbanner.edit', compact('mainbanner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mainbanner $mainbanner)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'mimes:jpg,jpeg,png,svg',
        ]);

        if ($request->hasFile('photo')) {
            unlink(public_path("bannerPhotos") . "/" . $mainbanner->photo);
            $storedPhotoName = time() . $request->photo->getClientOriginalName();
            $request->file('photo')->move(public_path("bannerPhotos"), $storedPhotoName);
            $mainbanner->photo = $storedPhotoName;
        }

        $mainbanner->title = $request->title;
        $mainbanner->description = $request->description;

        $mainbanner->save();

        return redirect()->route('mainbanner.index')->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mainbanner $mainbanner)
    {
        unlink(public_path("bannerPhotos") . "/" . $mainbanner->photo);
        $mainbanner->delete();

        return redirect()->route('mainbanner.index')->with('success', 'Banner deleted successfully.');
    }
}