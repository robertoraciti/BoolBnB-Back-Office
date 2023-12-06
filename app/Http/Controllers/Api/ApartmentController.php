<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Illuminate\Http\Request;

use App\Models\Apartment;
use App\Models\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::select('id', 'user_id', 'name', 'description', 'address', 'latitude', 'longitude', 'rooms', 'beds', 'bathrooms', 'mq', 'price', 'cover_image')
            ->with('services:id,name,icon')
            ->where('visibility', 1)
            ->orderBy('id', 'desc')
            ->paginate(12);

        if (!$apartments) {
            abort(404, 'apartments not found');
        }
        // TO DO: Insert image
        foreach ($apartments as $apartment) {
            $apartment->description = $apartment->getAbstract(200);
            // cover image
            $apartment->cover_image = $apartment->getAbsUriImage();
        }

        return response()->json($apartments);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::select('id', 'user_id', 'name', 'description', 'address', 'latitude', 'longitude', 'rooms', 'beds', 'bathrooms', 'mq', 'price', 'cover_image')
            ->with('services:id,name,icon')
            ->where('id', $id)
            ->first();

        if (!$apartment) {
            abort(404, 'Apartment not found');
        }

        // if there was a cover image  
        $apartment->cover_image = $apartment->getAbsUriImage();

        return response()->json($apartment);
    }

    public function homepageSearch($lat, $lon, $radius)
    {
        $apartments = Apartment::select('id', 'user_id', 'name', 'description', 'address', 'latitude', 'longitude', 'rooms', 'beds', 'bathrooms', 'mq', 'price', 'cover_image')
            ->with('services:id,name,icon')
            // ->where('address', "LIKE", "%" . $address . "%")
            ->get();

        if (!$apartments) {
            abort(404, 'Apartment not found');
        }

        $filterApartments = [];

        foreach ($apartments as $apartment) {


            if ($this->distanceBetweenTwoPoints($lat, $lon, $apartment->latitude, $apartment->longitude) < $radius) {
                array_push($filterApartments, $apartment);
            }
        }

        // if there was a cover image  
        // $apartment->cover_image = $apartment->getAbsUriImage();

        return response()->json($filterApartments);

    }



    public function advancedSearch($lat, $lon, $radius, $rooms, $beds)
    {
        $apartments = Apartment::select('id', 'user_id', 'name', 'description', 'address', 'latitude', 'longitude', 'rooms', 'beds', 'bathrooms', 'mq', 'price', 'cover_image')
            ->with('services:id,name,icon')
            // ->where('address', "LIKE", "%" . $address . "%")
            // ->where('latitude', $latitude)
            // ->where('longitude', $longitude)
            ->where('rooms', '>=', $rooms)
            ->where('beds', '>=', $beds)
            ->get();



        if (!$apartments) {
            abort(404, 'Apartment not found');
        }

        $filterApartments = [];

        foreach ($apartments as $apartment) {


            if ($this->distanceBetweenTwoPoints($lat, $lon, $apartment->latitude, $apartment->longitude) < $radius) {
                array_push($filterApartments, $apartment);
            }
        }

        // if there was a cover image  
        // $apartment->cover_image = $apartment->getAbsUriImage();

        return response()->json($filterApartments);

    }

    public function distanceBetweenTwoPoints(
        $latitudeFrom,
        $longitudeFrom,
        $latitudeTo,
        $longitudeTo,
        $earthRadius = 6378
    ) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
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

    public function apartmentsByFilters(Request $request)
    {
        $filters = $request->all();

        $apartments_query = Apartment::select('id', 'user_id', 'name', 'description', 'address', 'latitude', 'longitude', 'rooms', 'beds', 'bathrooms', 'mq', 'price', 'cover_image')
            ->where('visibility', 1)
            ->with('services:id,name,icon')
            ->orderByDesc('id');


        // foreach ($apartments_query as $apartment) {
        //     $apartment->description = $apartment->getAbstract(200);
        //     // cover image
        //     $apartment->cover_image = $apartment->getAbsUriImage();
        // }

        if (!empty($filters['activeApartmentServices'])) {
            foreach ($filters['activeApartmentServices'] as $service) {
                $apartments_query->whereHas('services', function ($query) use ($service) {
                    $query->where('service_id', $service);
                });
            }
        }

        if (!empty($filters['activeRooms'])) {
            $apartments_query->where('rooms', '>=', $filters['activeRooms']);
        }

        if (!empty($filters['activeBeds'])) {
            $apartments_query->where('beds', '>=', $filters['activeBeds']);
        }

        $apartments = $apartments_query->paginate(30);

        $filterApartments = [];

        foreach ($apartments as $apartment) {


            if ($this->distanceBetweenTwoPoints($filters['activeLat'], $filters['activeLng'], $apartment->latitude, $apartment->longitude) < 50) {
                array_push($filterApartments, $apartment);
            }
        }

        return response()->json($filterApartments);
    }

    public function apartmentView(Request $request, $id)
    {
        $apartment = Apartment::findOrFail($id);
        $userIP = $request->ip();

        $view = View::where('apartment_id', $apartment->id)
            ->where('ip_address', $userIP)
            ->first();

        if (!$view) {
            $view = new View();
            $view->apartment_id = $apartment->id;
            $view->ip_address = $userIP;
            $view->save();
            // $apartment->views += 1;
            // $apartment->save();
        }

        return response()->json($apartment);
    }
}