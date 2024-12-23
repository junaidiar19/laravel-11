<?php

namespace App\Exports;

use App\Models\Visitor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class VisitorExport implements FromView, ShouldQueue
{
    use Exportable;

    protected $chunkSize;

    public function __construct($chunkSize = 100)
    {
        $this->chunkSize = $chunkSize;
    }

    public function view(): View
    {
        // Initialize an empty array to hold visitors
        $visitors = [];

        // Use chunking to load visitors in smaller batches
        Visitor::chunk($this->chunkSize, function ($chunk) use (&$visitors) {
            foreach ($chunk as $visitor) {
                $visitors[] = $visitor;
            }
        });

        return view('exports.visitors', [
            'visitors' => $visitors
        ]);
    }
}
