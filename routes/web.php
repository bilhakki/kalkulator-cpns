<?php

use App\Models\Device;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('device', function (Request $request) {
    $device = Device::where("fingerprint", $request->fingerprint)->first();
    if (!$device) {
        $response = Http::get("https://api.ipify.org/?format=json");
        $body = $response->object();
        $ip = $body->ip;
        $response = Http::get("http://ip-api.com/json/{$ip}");
        $data = $response->object();

        $device = new Device();
        $device->fingerprint = $request->fingerprint;
        $device->ip = $ip;
        $device->country = $data->country;
        $device->regionName = $data->regionName;
        $device->city = $data->city;
        $device->timezone = $data->timezone;
        $device->as = $data->as;
        $device->isp = $data->isp;

        // $device->fingerprint = $request->fingerprint;
        // $device->ip = $request->ip;
        // $device->country = $request->country;
        // $device->regionName = $request->regionName;
        // $device->city = $request->city;
        // $device->timezone = $request->timezone;
        // $device->as = $request->as;
        // $device->isp = $request->isp;
        $device->save();
    }
    return response()->json($device);
});

Route::post("save", function (Request $request) {
    $device = Device::where("fingerprint", $request->fingerprint)->first();
    $point = Point::where("device_id", $device->id)->first();
    if (!$point) {
        $point = new Point();
    }
    $point->device_id = $device->id;
    $point->skd = $request->skd;
    $point->skb = $request->skb;
    $point->wawancara = $request->wawancara;
    $point->tpk = $request->tpk;
    $point->totalScore = $request->totalScore;
    $point->save();

    return response()->json($point);
});
