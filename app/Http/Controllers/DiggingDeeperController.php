<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessVideoJob;
use App\Jobs\GenerateCatalog\GenerateCatalogMainJob;

class DiggingDeeperController extends Controller
{
    public function processVideo()
    {
        ProcessVideoJob::dispatch();
    }

    public function prepareCatalog()
    {
        GenerateCatalogMainJob::dispatch();
    }
}
