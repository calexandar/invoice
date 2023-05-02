<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $allInvoices = Invoice::all();

        return view('invoice.index', compact('allInvoices'));
    }
}
