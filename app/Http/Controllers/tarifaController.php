<?php
namespace App\Http\Controllers;

use App\Models\Numeraha;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Models\FilamentModel; // Use your actual model
use Illuminate\Http\Request;

class TarifaController extends Controller
{
    public function downloadInvoice($id)
    {
        // Fetch the filament data using the ID
        $filament = Numeraha::find($id);

        if (!$filament) {
            return redirect()->back()->with('error', 'Filament not found.');
        }

        // Create a Buyer instance with customer data
        $customer = new Buyer([
            'name' => $filament->customer_name ?? 'Unknown', // Fallback to 'Unknown'
            'custom_fields' => [
                'email' => $filament->customer_email ?? 'no-email@example.com', // Fallback email
            ],
        ]);

        // Handle potential null values in the item details
        $itemName = $filament->item_name ?? 'Unnamed Item';
        $itemPrice = $filament->price ?? 0; // Fallback price
        $itemQuantity = $filament->quantity ?? 1; // Default quantity to 1

        // Create InvoiceItem instances for each row data
        $item = InvoiceItem::make($itemName)
            ->pricePerUnit($itemPrice)
            ->quantity($itemQuantity);

        // Create the invoice
        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10) // Adjust discount as necessary
            ->taxRate(15) // Adjust tax rate as necessary
            ->shipping(1.99) // Adjust shipping as necessary
            ->addItem($item);

        // Stream the invoice as a downloadable PDF
        return $invoice->stream();
    }
}
