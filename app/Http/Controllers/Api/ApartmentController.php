<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Apartment;
use App\Models\Service;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::select('id','type_id','name','description')
            ->with('services:id,name,icon')
            ->orderBy('id', 'desc')
            ->paginate(12);

            if (!$apartments) {
                abort(404, 'apartments not found');
            }    
        // foreach ($apartments as $apartment) {
            // $apartment->description = $apartment->getAbstract(200);
            // if there was a cover image
            // $apartment->cover_image = $apartment->getAbsUriImage();
        // }

        return response()->json($apartments);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::select('id','type_id','name','slug','description')
            ->with('technologies:id,colour,label','type:id,colour,name')
            // ->where('slug', $slug)
            ->first();

            if (!$apartment) {
                abort(404, 'Apartment not found');
            }

            // if there was a cover image  
            // $apartment->cover_image = $apartment->getAbsUriImage();

        return response()->json($apartment);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function portfolioByType($type_id)
    // {   
    //     $projects = Project::select('id','type_id','name','slug','description')
    //         ->with('technologies:id,colour,label','type:id,colour,name')
    //         ->where('type_id', $type_id)
    //         ->orderBy('id')
    //         ->paginate(12);

    //    return response()->json($projects);
    // }
}