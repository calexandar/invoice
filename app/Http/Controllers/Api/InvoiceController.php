<?php

namespace App\Http\Controllers\Api;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Invoice::all();

        return InvoiceResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\InvoiceStoreRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $status = $data['status'] ?? null;

        $invoice = Invoice::select('status')
            ->where('status', '=', 'approved')
            ->where('status', '=', 'rejected')    
            ->first();

        // $invoice = Invoice::findOrFail($request->invoice_id);

         // Check if the current status of the invoice is the same as the requested status
        if ($invoice->status === $status) {
            return response()->json([
                'error' => true,
                'message' => 'Invoice is already '.$status.'.'
        ]);

        }

        // Update the status of the invoice
        $invoice->status = $data['status'];

        $invoice = Invoice::create($data);

        return new InvoiceResource($invoice);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
