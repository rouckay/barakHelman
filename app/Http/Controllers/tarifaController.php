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
            'name' => $filament->numera_number ?? 'Unknown', // Fallback to 'Unknown'
            'custom_fields' => [
                'email' => $filament->save_number ?? 'no-email@example.com', // Fallback email
            ],
        ]);

        // Handle potential null values in the item details
        $numera_number = $filament->numera_number ?? 'Unnamed Item';
        $save_number = $filament->save_number ?? 0; // Fallback price
        $numera_price = $filament->numera_price ?? 1; // Default quantity to 1

        // Create InvoiceItem instances for each row data
        $item = InvoiceItem::make($numera_number)
            ->pricePerUnit($save_number)
            ->quantity($numera_price);

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
