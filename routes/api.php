<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\VisitorActionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodTypeController;
use App\Http\Controllers\FoodSpinerController;
use App\Http\Controllers\DataEntryAuthController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Artisan;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);
//restaurants.
Route::get('/restaurant', [RestaurantController::class, 'get']);
Route::post('/restaurants/search', [RestaurantController::class, 'search']);


Route::get('/restaurants/recommended/{language}', [RestaurantController::class, 'getRecommendedRestaurantsbylang']);



Route::post('/restaurants/recommended', [RestaurantController::class, 'getRecommendedRestaurants']);



Route::get('/restaurants/food/{food_id}', [RestaurantController::class, 'getByFoodId']);



//ranked &randomly
Route::post('restaurants/random', [RestaurantController::class, 'getAllRestaurantsRandomly']);
Route::post('/restaurants/sorted-by-price', [RestaurantController::class, 'getRestaurantsSortedByPrice']);
//admin
Route::middleware(['auth:sanctum'])->group(function () {
Route::get('/visitor-actions/counts', [VisitorActionController::class, 'actionCounts']);
// Route::get('/visitor-actions/counts/{id}', [VisitorActionController::class, 'actionCountsbyid']);
// Route::post('/visitor-actions', [VisitorActionController::class, 'store']);

});
Route::get('/visitor-actions/counts/{rest_id}', [VisitorActionController::class, 'actionCountsById']);
Route::post('/visitor-actions', [VisitorActionController::class, 'store']);
//data-entry
Route::post('/data-entry/register', [DataEntryAuthController::class, 'register']);
Route::post('/data-entry/login', [DataEntryAuthController::class, 'login']);


Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/update-password/{user_id}', [AuthController::class, 'updatePassword']);



//admin_spiner-food
Route::middleware(['auth:sanctum'])->group(function () {

// Route::post('/addrestaurant_info', [RestaurantController::class,'store']);
Route::post('/spiner-food', [FoodTypeController::class, 'store']);
Route::put('/spiner-food/{id}', [FoodTypeController::class, 'update']);
Route::delete('/spiner-food/{id}', [FoodTypeController::class, 'destroy']);
});


Route::get('/spiner-food/active', [FoodSpinerController::class, 'getAllFoodsWithStatusTrue']);
Route::get('/spiner-food/wheel', [FoodSpinerController::class, 'getMostPriorityFood']);


route::get('/recommended',[RestaurantController::class,'getRecommendedRestaurants']);

Route::get('/link', function () {
    try {

        Artisan::call('route:clear');


        return response()->json(['message' => 'route cleared successfully.'], 200);
    } catch (\Exception $e) {

        return response()->json(['message' => 'Failed', 'error' => $e->getMessage()], 500);
    }
});




Route::get('/cache/clear', function () {
    try {
        // Clear the application cache
        Artisan::call('config:clear');

        return response()->json(['message' => 'Cache cleared successfully.'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to clear cache', 'error' => $e->getMessage()], 500);
    }
});




Route::post('/addrestaurant_info', [RestaurantController::class,'store']);
/////////comment  searc





Route::post('/blogs', [BlogController::class, 'store']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);
Route::get('/food_type', [FoodTypeController::class, 'index']);


//dashboard for admin
Route::get('/actions/homepage', [VisitorActionController::class, 'getHomepageActions']);
Route::get('/actions/visitor-count', [VisitorActionController::class, 'getVisitorCount']);
Route::get('/actions/visitor-count/total', [VisitorActionController::class, 'getUniqueVisitorCount']);



///////qr code



use App\Http\Controllers\QrCodeController;

Route::post('/generate-qr-code', [QrCodeController::class, 'generateQrCodeapi']);


Route::get('/track-scan/{id}', [QrCodeController::class, 'trackScanapi']);
