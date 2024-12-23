<?php

namespace App\Http\Controllers;

use App\Exports\AnswerEssayExport;
use App\Exports\VisitorExport;
use App\Models\AnswerEssay;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function __construct(public $disk = 'exports') {}

    public function index()
    {
        // load from storage/app/public/exports
        $files = collect(Storage::disk($this->disk)->files($this->disk))->map(function ($file) {
            $created_at = Storage::disk($this->disk)->lastModified($file);
            $size = Storage::disk($this->disk)->size($file);
            $isNew = Carbon::createFromTimestamp($created_at)->diffInMinutes(now()) < 10;

            return [
                'name' => basename($file),
                'url' => Storage::disk($this->disk)->temporaryUrl($file, now()->addMinutes(1)),
                'size' => $this->convertBytes($size, 'MB'),
                'created_at' => $created_at,
                'created_at_human' => Carbon::createFromTimestamp($created_at)->diffForHumans(),
                'is_new' => $isNew,
            ];
        })->sortByDesc('created_at');

        // return $files;

        return view('pages.exports.index', compact('files'));
    }

    public function visitor()
    {
        // process export directly
        // return Excel::download(new VisitorExport($visitors), 'visitors.xlsx');

        // process export in queue
        $title = 'exports/visitors' . '_' . now()->format('Y-m-d_H-i-s');
        (new VisitorExport)->queue("$title.xlsx", "exports");

        flash()->success('Proses export sedang berjalan. Silahkan cek file yang sudah di export di menu Export.');
        return back();
    }

    public function download(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401, 'Invalid or expired signature.');
        }

        $path = $request->query('path');

        return Storage::disk('exports')->download($path);
    }

    private function convertBytes($bytes, $toUnit = 'MB', $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB'];

        if (!in_array($toUnit, $units)) {
            throw new InvalidArgumentException("Invalid unit specified. Choose from " . implode(', ', $units) . ".");
        }

        $toUnitIndex = array_search($toUnit, $units);
        $convertedValue = $bytes / pow(1024, $toUnitIndex);
        return round($convertedValue, $precision) . " " . $toUnit;
    }
}
