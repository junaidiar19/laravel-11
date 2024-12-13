<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::paginate(10);

        return view('pages.visitors.index', compact('visitors'));
    }
}
