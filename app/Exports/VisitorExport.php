<?php

namespace App\Exports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class VisitorExport implements FromView, ShouldQueue
{
    use Exportable;

    public $visitors;

    public function __construct($visitors)
    {
        $this->visitors = $visitors;
    }

    // public function collection()
    // {
    //     return $this->visitors;
    // }

    public function view(): View
    {
        return view('exports.visitors', [
            'visitors' => $this->visitors,
        ]);
    }
}
