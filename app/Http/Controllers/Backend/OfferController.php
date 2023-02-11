<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $offers = Offer::select('id', 'offer_name', 'offer_value', 'offer_start', 'offer_expiry', 'status')->get();
        return view('backend.offer.index', compact('offers'));
    }

    public function create()
    {
        return view('backend.offer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'offer_name' => 'required|unique:offers',
            'offer_type' => 'required',
            'offer_value' => 'required',
            'offer_start' => 'required',
            'offer_expiry' => 'required|after_or_equal:offer_start'
        ],[
            'offer_name.required' => 'Offer name is required',
            'offer_name.unique' => 'Offer name already exists',
            'offer_type.required' => 'Offer type is required',
            'offer_value.required' => 'Offer value is required',
            'offer_start.required' => 'Offer start is required',
            'offer_expiry.required' => 'Offer expiry is required',
            'offer_expiry.after_or_equal' => 'Offer expiry is not correct'
        ]);

        $offer_start = Carbon::parse($request->offer_start)->format('Y-m-d' . ' ' . '00:00:00');
        $offer_expiry = Carbon::parse($request->offer_expiry)->format('Y-m-d' . ' ' . '23:59:59');

        $offer = new Offer;
        $offer->offer_name = $request->offer_name;
        $offer->offer_type = $request->offer_type;
        $offer->offer_value = $request->offer_value;
        $offer->offer_start = $offer_start;
        $offer->offer_expiry = $offer_expiry;
        $offer->status = $request->status;
        $offer->save();

        return redirect()->back()->with('success', 'Updated');
    }


    public function show($id)
    {
        $offer = Offer::findorfail($id);
        return view('backend.offer.show', compact('offer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'offer_name' => 'required',
            'offer_type' => 'required',
            'offer_value' => 'required',
            'offer_start' => 'required',
            'offer_expiry' => 'required|after_or_equal:offer_start'
        ],[
            'offer_name.required' => 'Offer name is required',
            'offer_type.required' => 'Offer type is required',
            'offer_value.required' => 'Offer value is required',
            'offer_start.required' => 'Offer start is required',
            'offer_expiry.required' => 'Offer expiry is required',
            'offer_expiry.after_or_equal' => 'Offer expiry is not correct'
        ]);

        $offer_start = Carbon::parse($request->offer_start)->format('Y-m-d' . ' ' . '00:00:00');
        $offer_expiry = Carbon::parse($request->offer_expiry)->format('Y-m-d' . ' ' . '23:59:59');

        $offer = Offer::findorFail($request->id);

        $updateOffer = $offer->update([
            'offer_name' => $request->offer_name,
            'offer_type' => $request->offer_type,
            'offer_value' => $request->offer_value,
            'offer_start' => $offer_start,
            'offer_expiry' => $offer_expiry,
            'status' => $request->status
        ]);

        if($updateOffer) {
            return redirect()->back()->with('success', 'Updated');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function delete($id)
    {
        $offer = Offer::findorFail($id);
        $offer->delete();

        return redirect('admin/offers')->with('success', 'Deleted successfully');
    }
}
