<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;

use App\Models\Advertisement;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Message;

use DateInterval;
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
        $advertisements = [];
        foreach ($apartments as $apartment) {

            $apartmentAdvertisements = DB::table('advertisement_apartment')->where('apartment_id', $apartment->id)->orderBy('expiration_date', 'asc')->get();

            foreach ($apartmentAdvertisements as $advertisement) {
                if ($apartment->visibility == 1) {
                    $todayDate = date_create();
                    $todayFormatted = date_format($todayDate, 'Y-m-d H:i:s');
                    $endDate = $advertisement->expiration_date;

                    if ($todayFormatted > $endDate) {

                        $apartment->visibility = 0;
                        $apartment->advertisements()->detach();
                    }
                }
                $apartment->save();
            }

            $advertisements[$apartment->id] = $apartmentAdvertisements;
        }
        return view('admin.apartments.index', compact('apartments', 'advertisements'));
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
        $advertisements = DB::table('advertisement_apartment')->where('apartment_id', $apartment->id)->get();
        $count = DB::table('messages')
            ->where('apartment_id', $apartment->id)
            ->count();
        return view('admin.apartments.show', compact('apartment', 'count', 'advertisements'));
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
        $advertisement = Advertisement::all();
        $data = $request->all();
        $apartment = Apartment::find($id);

        $now = date_create();
        $start_date = date_create();

        if ($data['advertisement_id'] == 1) {

            date_add($now, date_interval_create_from_date_string("24 hours"));
            $expiration = date_format($now, 'Y-m-d H:i:s');
        } elseif ($data['advertisement_id'] == 2) {
            date_add($now, date_interval_create_from_date_string("72 hours"));
            $expiration = date_format($now, 'Y-m-d H:i:s');
        } else {
            date_add($now, date_interval_create_from_date_string("144 hours"));
            $expiration = date_format($now, 'Y-m-d H:i:s');
        }
        // dd($formatNow, $expiration);
        $apartment->visibility = 1;

        if ($apartment->advertisements()->exists(['apartment_id' => $apartment->id])) {
            abort('403', 'Promozione già attiva su questo appartamento');
        } else {

            $formatStartDate = date_format($start_date, 'Y-m-d H:i:s');
            $apartment->advertisements()->attach($data['advertisement_id'], ['start_date' => $formatStartDate, 'expiration_date' => $expiration]);
        }


        $apartment->save();

        return redirect()->route('admin.apartments.show', $apartment)->with('message_type', 'success')->with('message', 'Promoted with success');
    }

    public function messages(Apartment $apartment)
    {
        $messages = Message::select('apartment_id', 'name', 'email', 'text', 'created_at')
            ->where('apartment_id', $apartment->id)
            ->orderBy('id', 'desc')
            ->paginate(6);

        $count = DB::table('messages')
            ->where('apartment_id', $apartment->id)
            ->count();

        return view('admin.apartments.messages', compact('apartment', 'messages', 'count'));
    }
}