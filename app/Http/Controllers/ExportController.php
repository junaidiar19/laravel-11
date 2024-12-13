<?php

namespace App\Http\Controllers;

use App\Exports\AnswerEssayExport;
use App\Exports\VisitorExport;
use App\Models\AnswerEssay;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function visitor()
    {
        // $visitors =  Visitor::chunk(500, function (Collection $visitors) {
        //     // return $visitors;
        // });

        // return $visitors;
        $visitors = Visitor::get();

        return Excel::download(new VisitorExport($visitors), 'visitors.xlsx');
        (new VisitorExport($visitors))->store('visitors.xlsx');

        return back();
    }

    public function essay()
    {
        $data = AnswerEssay::query()
            // ->where('id', '>=', 5053)
            // ->where('id', '<=', 5054)
            // ->where('id', '!=', '5052')
            ->where('id', '5052')
            // ->where('id', '342')
            ->latest()
            ->get()
            ->each(function ($item) {
                $item->content = preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', ' ', $item->content);
            });

        // return str()->length($data->first()->content);
        // return $data;

        // return view('exports.answer-essay', compact('data'));

        return Excel::download(new AnswerEssayExport($data), 'essay.xlsx');
    }
}
