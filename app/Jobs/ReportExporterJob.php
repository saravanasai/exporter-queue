<?php

namespace App\Jobs;

use App\Events\ExportReportEvent;
use App\Models\Reports;
use App\Models\Sales;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReportExporterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Reports $reports)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $sales = Sales::query()->selectRaw($this->reports->columns)->get();

        foreach ($sales as $key => $sale) {
            Log::info("Row:", [$sale]);

        }
        sleep(10);
        $reportId = $this->reports->id;
        Log::info("Event trigger");
        event(new ExportReportEvent($reportId));
    }
}
