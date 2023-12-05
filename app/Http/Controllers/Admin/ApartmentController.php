<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;

use App\Models\Advertisement;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Message;

use Illuminate\Http\Request;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::orderBy('id', 'desc')->where('user_id', '=', Auth::user()->id)->paginate(8);
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * *@return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * *@return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        $data = $request->validated();
        $apartment = new Apartment();
        $apartment->fill($data);
        $user = Auth::user()->id;
        $apartment->user()->associate($user);

        if ($request->hasFile('cover_image')) {
            $cover_image_path = Storage::put("uploads/apartments/cover_image", $data['cover_image']);
            $apartment->cover_image = $cover_image_path;
        }

        $apartment->save();

        if (Arr::exists($data, 'services')) {
            $apartment->services()->attach($data['services']);
        }

        return redirect()->route('admin.apartments.show', $apartment)->with('message_type', 'success')->with('message', 'Created with success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * *@return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $count = DB::table('messages')
            ->where('apartment_id',$apartment->id)
            ->count();
        return view('admin.apartments.show', compact('apartment','count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        $service_ids = $apartment->services->pluck('id')->toArray();

        return view('admin.apartments.edit', compact('apartment', 'services', 'service_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     ** @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $data = $request->validated();
        // dd($data);
        $apartment->fill($data);

        if ($request->hasFile('cover_image')) {
            if ($apartment->cover_image) {
                Storage::delete($apartment->cover_image);
            }
            $cover_image_path = Storage::put("uploads/apartments/cover_image", $data['cover_image']);
            $apartment->cover_image = $cover_image_path;
        }

        $apartment->save();

        if (Arr::exists($data, 'services')) {
            $apartment->services()->sync($data['services']);
        } else {
            $apartment->services()->detach();
        }
        return redirect()->route('admin.apartments.show', $apartment)->with('message_type', 'success')->with('message', 'Updated with success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     ** @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->services()->detach();
        if ($apartment->cover_image) {
            Storage::delete($apartment->cover_image);
        }
        $apartment->delete();
        return redirect()->route('admin.apartments.index')->with('message_type', 'danger')->with('message', 'Deleted with success');
    }

    public function advertise(Apartment $apartment)
    {
        $advertisePlans = Advertisement::all();
        return view('admin.apartments.advertise', compact('apartment', 'advertisePlans'));
    }

    public function advCheckout(Request $request, $id)
    {
        $data = $request->all();
        $apartment = Apartment::find($id);

        $apartment->advertisements()->attach($data['advertisement_id']);

        $apartment->visibility = 1;
        $apartment->save();

        return redirect()->route('admin.apartments.show', $apartment)->with('message_type', 'success')->with('message', 'Promoted with success');
    }

    public function messages(Apartment $apartment)
    {
        $messages = Message::select('apartment_id','name','email','text','created_at')
            ->where('apartment_id', $apartment->id)
            ->orderBy('id','desc')
            ->paginate(6);

        $count = DB::table('messages')
            ->where('apartment_id',$apartment->id)
            ->count();
        
        return view('admin.apartments.messages', compact('apartment','messages','count'));
    }
}