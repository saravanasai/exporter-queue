<?php

use App\Events\ExportReportEvent;
use App\Jobs\ReportExporterJob;
use App\Models\Reports;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

    Auth::loginUsingId(1);

    $reports =  Reports::all();

    return view('welcome', compact('reports'));
});


Route::get('/export', function () {

    $reportId = request('id');
    $report = Reports::find((int) $reportId);

    dispatch(new ReportExporterJob($report));

    return response()->noContent();
});

Route::get('/webhook', function () {

    $reportId = request('id');

    $report = Reports::find((int) $reportId);
    Log::info("Webhook Handled");

    event(new ExportReportEvent($report->id));
});
