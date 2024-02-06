<?php

namespace App\Http\Controllers;

use App\Models\Ourservice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class OurserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ourservices = Ourservice::latest()->paginate(5);

        return view('ourservices.index',compact('ourservices'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('ourservices.create');
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png,svg'
        ]);

        //
        $photo = $request->file("photo");
        $storedPhotoName = time() . $request->photo->getClientOriginalName();
        $request->photo = $storedPhotoName;

        $photo->move(public_path("servicePhotos"), $storedPhotoName);

        // add to database
        /* Product::create($request->all()); */
        $ourservice = new Ourservice();
        $ourservice->title = $request->title;
        $ourservice->description = $request->description;
        $ourservice->photo = $storedPhotoName;

        $ourservice->save();
        return redirect()->route('ourservices.index')
                        ->with('success','Service created successfully.');

    }

      /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Ourservice $ourservice)
    {
        //
        return view('ourservices.show',compact('ourservice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ourservice $ourservice)
    {
        //
        return view('ourservices.edit',compact('ourservice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ourservice $ourservice)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'mimes:jpg,jpeg,png,svg'
        ]);


        if($request->photo != null) {  // form photo field is not empty
            unlink(public_path("servicePhotos")."/".$ourservice->photo);

            $photo = $request->file("photo");
            $storedPhotoName = time() . $request->photo->getClientOriginalName();
            /* $request->photo = $storedPhotoName; */
            $ourservice->photo = $storedPhotoName;
            $photo->move(public_path("servicePhotos"), $storedPhotoName);
        }

        // add to database
        $ourservice->title = $request->title;
        $ourservice->description = $request->description;

        $ourservice->update();



        return redirect()->route('ourservices.index')
                        ->with('success','Service updated successfully.');
   }


   /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ourservice $ourservice)
    {
        //
        unlink(public_path("servicePhotos")."/".$ourservice->photo);

        $ourservice->delete();

        return redirect()->route('ourservices.index')
                        ->with('success','Service deleted successfully.');

    }
}