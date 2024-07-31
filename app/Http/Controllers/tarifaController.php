<?php

namespace App\Http\Controllers;

use App\Models\tarifa;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class tarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = new Buyer([
            'name' => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item);

        return $invoice->stream();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(tarifa $tarifa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tarifa $tarifa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tarifa $tarifa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tarifa $tarifa)
    {
        //
    }
}
