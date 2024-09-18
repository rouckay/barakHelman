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
    }
    public function downloadsoldDocs($id)
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
        $html = view('numerahDocs', compact('numeraha_id', 'customer_id', 'customer', 'father_name', 'tazkira', 'sharwali_tarifa_price', 'date'))->render();

        // Pass the rendered HTML to TCPDF
        $pdf::writeHTML($html, true, false, true, false, '');

        // Output PDF as download
        return $pdf::Output('د نمری سند.pdf', 'D');
    }
}
