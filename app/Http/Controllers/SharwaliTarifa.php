<?php

namespace App\Http\Controllers;

use App\Models\CustomerNumeraha;
use App\Models\Numeraha;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Models\FilamentModel; // Use your actual model
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Elibyy\TCPDF\Facades\TCPDF;
use FontLib\Table\Type\name;
// use PDF;
use Carbon\Carbon;

class SharwaliTarifa extends Controller
{
    public function downloadInvoice($id)
    {
        $filament = CustomerNumeraha::with(['customer', 'numeraha'])->find($id);

        // Handle potential null values in the item details
        $numeraha_id = $filament->numeraha_id ?? 'Unnamed Item';
        $customer_id = $filament->customer_id ?? 0; // Fallback price
        $customer = $filament->customer->name ?? 'Unknown';
        $father_name = $filament->customer->father_name ?? 'Unknown';
        $tazkira = $filament->customer->tazkira ?? 'Unknown';
        $sharwali_tarifa_price = $filament->numeraha->sharwali_tarifa_price ?? '0 AFG';
        $date = Carbon::now();

        $pdf = new TCPDF();

        // Set document information
        $pdf::SetAuthor('Your Name');
        $pdf::SetTitle('Persian PDF');

        // Set RTL language support if needed
        $pdf::setRTL(true);

        // Add a page
        $pdf::AddPage();

        // Render Blade template into HTML with data
        $html = view('pdf', compact('numeraha_id', 'customer_id', 'customer', 'father_name', 'tazkira', 'sharwali_tarifa_price', 'date'))->render();

        // Pass the rendered HTML to TCPDF
        $pdf::writeHTML($html, true, false, true, false, '');

        // Output PDF as download
        return $pdf::Output('تعرفه.pdf', 'D');

        // $filament = Numeraha::find($id);

        // if (!$filament) {
        //     return redirect()->back()->with('error', 'Filament not found.');
        // }

        // // Create a Buyer instance with customer data
        // $customer = new Buyer([
        //     'name' => $filament->numera_number ?? 'Unknown', // Fallback to 'Unknown'
        //     'custom_fields' => [
        //         'email' => $filament->save_number ?? 'no-email@example.com', // Fallback email
        //     ],
        // ]);

        // // Handle potential null values in the item details
        // $numera_number = $filament->numera_number ?? 'Unnamed Item';
        // $save_number = $filament->save_number ?? 0; // Fallback price
        // $numera_price = $filament->numera_price ?? 1;

        // // Create InvoiceItem instances for each row data
        // $item = InvoiceItem::make($numera_number)
        //     ->pricePerUnit($save_number)
        //     ->quantity($numera_price);

        // // Create the invoice
        // $invoice = Invoice::make()
        //     ->buyer($customer)
        //     ->discountByPercent(10) // Adjust discount as necessary
        //     ->taxRate(15) // Adjust tax rate as necessary
        //     ->shipping(1.99) // Adjust shipping as necessary
        //     ->addItem($item);

        // // Stream the invoice as a downloadable PDF
        // return $invoice->stream();
    }
}
