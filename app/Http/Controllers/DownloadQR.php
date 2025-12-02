<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registered;
use App\Models\Event;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Models\EventDetail;

class DownloadQR extends Controller
{
    public function download($fileName)
    {
        $path = storage_path("app/public/qr/" . $fileName);

        if (!file_exists($path)) {
            abort(404, "QR not found");
        }

        return response()->download($path);
    }
}
