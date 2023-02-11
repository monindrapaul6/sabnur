<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function postFeedback(Request $request){
        $feedback = new Feedback;
        $feedback->user_id = Auth::user()->id;
        $feedback->invoice_id = $request->invoice_id;
        $feedback->rating = $request->rating;
        $feedback->description = $request->description;
        $feedback->save();

        return redirect()->back();
    }
}
