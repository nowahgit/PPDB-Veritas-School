<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    /**
     * Display file from storage
     */
    public function show($path)
    {
        // Decode path
        $filePath = base64_decode($path);

        // Check if file exists in public disk
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File not found');
        }

        // Get file
        $file = Storage::disk('public')->get($filePath);
        $fullPath = Storage::disk('public')->path($filePath);
        $mimeType = mime_content_type($fullPath);

        // Return file response
        return Response::make($file, 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"'
        ]);
    }
}
