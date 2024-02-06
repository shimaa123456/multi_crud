<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $features = Feature::latest()->paginate(5);

        return view('features.index',compact('features'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png,svg',
            'icon' => 'required|mimes:jpg,jpeg,png,svg'
        ]);

        //
        $photo = $request->file("photo");
        $storedPhotoName = time() . $request->photo->getClientOriginalName();
        $request->photo = $storedPhotoName;

        $photo->move(public_path("featurePhotos"), $storedPhotoName);

        $icon = $request->file("icon");
        $storedIconName = time() . $request->icon->getClientOriginalName();
        $request->icon = $storedIconName;

        $icon->move(public_path("featureIcons"), $storedIconName);

        // add to database
        /* Product::create($request->all()); */
        $feature = new Feature();
        $feature->title = $request->title;
        $feature->description = $request->description;
        $feature->photo = $storedPhotoName;
        $feature->icon = $storedIconName;

        $feature->save();
        return redirect()->route('features.index')
                        ->with('success','feature created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        //
        return view('features.show',compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        //
        return view('features.edit',compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'mimes:jpg,jpeg,png,svg',
            'icon' => 'mimes:jpg,jpeg,png,svg'
        ]);


        if($request->photo != null) {  // form photo field is not empty
            unlink(public_path("featurePhotos")."/".$feature->photo);

            $photo = $request->file("photo");
            $storedPhotoName = time() . $request->photo->getClientOriginalName();
            /* $request->photo = $storedPhotoName; */
            $feature->photo = $storedPhotoName;
            $photo->move(public_path("featurePhotos"), $storedPhotoName);
        }

        if($request->icon != null) {  // form photo field is not empty
            unlink(public_path("featureIcons")."/".$feature->icon);

            $icon = $request->file("icon");
            $storedIconName = time() . $request->icon->getClientOriginalName();
            /* $request->photo = $storedPhotoName; */
            $feature->icon = $storedIconName;
            $icon->move(public_path("featureIcons"), $storedIconName);
        }

        // add to database
        $feature->title = $request->title;
        $feature->description = $request->description;

        $feature->update();



        return redirect()->route('features.index')
                        ->with('success','Feature updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)

   {
        //
        unlink(public_path("featurePhotos")."/".$feature->photo);
        unlink(public_path("featureIcons")."/".$feature->icon);
        $feature->delete();

        return redirect()->route('features.index')
                        ->with('success','Feature deleted successfully.');
    }
}