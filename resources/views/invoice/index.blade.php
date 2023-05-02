@extends('layouts.app')

@section('content')
@foreach ($allInvoices as $invoice)
<div class="flex items-center justify-center min-h-screen bg-gray-100 p-16">
    <div class="w-3/5 bg-white shadow-lg">
        <div class="flex justify-between p-4">
            <div>
                <h1 class="text-3xl italic font-extrabold tracking-widest text-black-500">{{ $invoice->company->name }}</h1>
                <p class="text-base w-2/5"><span class="text-sm">
                    {{ $invoice->company->street }},{{ $invoice->company->city }}, {{ $invoice->company->zip }}
                </span></p>
            </div>
            <div class="p-2">
                <ul class="flex">
                    <li class="flex flex-col items-center p-2 ">
                        <h1 class="text-3xl font-bold tracking-widest text-black-500">INVOICE</h1>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="w-full h-0.5 bg-indigo-500"></div>
        <div class="flex justify-between p-4">
         
            <div class="w-40 mr-4">
                <address class="text-sm">
                    <span class="font-bold"> Billed To</span><br>
                    Joe Smith
                    795 Folsom Ave
                    San Francisco, CA 94107
                    P: (123) 456-7890
                </address>
            </div>
            <div class="w-40">
                <address class="text-sm">
                    <span class="font-bold">Ship To</span><br>
                    Joe doe
                    800 Folsom Ave
                    San Francisco, CA 94107
                    P: + 111-456-7890
                </address>
            </div>
            <div>
                <h6 class="font-bold">Invoice # </h6>
                <h6 class="font-bold">Invoice Date </h6>
                <h6 class="font-bold">P.O.# </h6>
                <h6 class="font-bold">Due Date </h6>
            </div>
            <div>
                <p><span class="text-sm font-medium"> {{ $invoice->number }}</span></p>
                <p><span class="text-sm font-medium"> {{ $invoice->created_at }}</span></p>
                <p><span class="text-sm font-medium"> 12/12/2022</span></p>
                <p><span class="text-sm font-medium"> {{ $invoice->due_date }}</span></p>
            </div>
        </div>
        <div class="flex justify-end p-4">
            <div class="border-b border-gray-200 shadow">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-xs text-gray-500 ">
                                QTY
                            </th>
                            <th class="px-4 py-2 text-xs text-gray-500 ">
                                DESCRIPTION
                            </th>
                            <th class="px-4 py-2 text-xs text-gray-500 ">
                                UNIT PRICE
                            </th>
                            <th class="px-4 py-2 text-xs text-gray-500 ">
                                AMOUNT
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($invoice->product as $product)
                        <tr class="whitespace-nowrap">
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $product->pivot->quantity }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ $product->name }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-500">
                                ${{ $product->price }}
                            </td>
                            <td class="px-6 py-4">
                                ${{ $product->pivot->quantity * $product->price }}
                            </td>
                        </tr>
                        @endforeach
                      

                        <tr class="">
                            <td colspan="2"></td>
                            <td class="text-sm font-bold">Sub Total</td>
                            <td class="text-sm font-bold tracking-wider"><b>$950</b></td>
                        </tr>
                        <!--end tr-->
                        <tr>
                            <th colspan="2"></th>
                            <td class="text-sm font-bold"><b>Sales Tax</b></td>
                            <td class="text-sm font-bold"><b>$6.25%</b></td>
                        </tr>
                        <!--end tr-->
                        <tr class="text-dark">
                            <th colspan="2"></th>
                            <td class="text-sm font-bold"><b>Total</b></td>
                            <td class="text-sm font-bold  bg-gray-100"><b>$999.0</b></td>
                        </tr>
                        <!--end tr-->

                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-between p-4">
            <div>
                <h3 class="text-sm font-bold">Terms & Condition</h3>
                <p class="text-xs">Payment is due within 15 days.</p>
                <br>
                <p class="text-xs">Please make checks payable to : East Repair Inc.</p>
            </div>
            <div class="p-4">
                <div class="text-4xl italic text-black-500">John Smith</div>
            </div>
        </div>
        <div class="w-full h-0.5 bg-indigo-500"></div>

                <div class="p-4">
                    <div class="flex items-center justify-center">
                        Thank you very much for doing business with us.
                    </div>
                    <div class="flex items-end justify-end space-x-3">
                        @if ($invoice->status == 'draft')
                        <button class="px-4 py-2 text-sm text-blue-600 bg-blue-100">Approve</button>    
                        <button class="px-4 py-2 text-sm text-red-600 bg-red-100">Reject</button>
                        @elseif($invoice->status == 'approved')
                        <button class="px-4 py-2 text-sm text-blue-600 bg-blue-100">Approve</button>  
                        @else 
                        <button class="px-4 py-2 text-sm text-red-600 bg-red-100">Reject</button>
                        @endif                           
                    </div>
                </div>

    </div>
</div>
@endforeach


@endsection