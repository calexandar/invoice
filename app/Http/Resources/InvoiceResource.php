<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $products = $this->product;

        foreach($products as $product) {
            $product_id = $product->pivot->product_id;
            $quantity = $product->pivot->quantity;
            $name = $product->name;
            $price = $product->price;
            $currency = $product->currency;
        }
        return [
            'id' => $this->id,
            'company_street' => $this->company->street,
            'company_city' => $this->company->city,
            'company_zip' => $this->company->zip,
            'invoice_number' => $this->number,
            'invoice_due_date'=> $this->due_date,
            'invoice_status' => $this->status,
            'product' => [
                'id' => $product_id,
                'quantity' => $quantity,
                'name' => $name,
                'price' => $price,
                'currency' => $currency,
            ],

            'created_at'=> (new \DateTime($this->created_at))->format('Y-m-d')
            
        ];
    }
}
