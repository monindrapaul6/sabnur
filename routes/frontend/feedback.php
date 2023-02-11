<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FeedbackController;

/*feedback*/
Route::post('postFeedback', [FeedbackController::class, 'postFeedback']);
