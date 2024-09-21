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
use Dompdf\Dompdf;
use Dompdf\Options;

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
        $grand_father_name = $filament->customer->grand_father_name ?? 'Unknown';
        $province = $filament->customer->province ?? 'Unknown';
        $village = $filament->customer->village ?? 'Unknown';
        $tazkira = $filament->customer->tazkira ?? 'Unknown';
        $mobile_number = $filament->customer->mobile_number ?? 'Unknown';
        $job = $filament->customer->job ?? 'Unknown';
        $Customer_image = $filament->customer->Customer_image ?? 'Unknown';
        $responsable_name = $filament->customer->responsable_name ?? 'Unknown';
        $responsable_father_name = $filament->customer->responsable_father_name ?? 'Unknown';
        $responsable_grand_father_name = $filament->customer->responsable_grand_father_name ?? 'Unknown';
        $responsable_province = $filament->customer->responsable_province ?? 'Unknown';
        $responsable_village = $filament->customer->responsable_village ?? 'Unknown';
        $responsable_tazkira = $filament->customer->responsable_tazkira ?? 'Unknown';
        $responsable_mobile_number = $filament->customer->responsable_mobile_number ?? 'Unknown';
        $responsable_image = $filament->customer->responsable_image ?? 'Unknown';
        $responsable_job = $filament->customer->responsable_job ?? 'Unknown';
        $responsable_ = $filament->customer->responsable_ ?? 'Unknown';
        //numerah Detail is started here

        $numera_id = $filament->numeraha->numera_id ?? '0 AFG';
        $numera_type = $filament->numeraha->numera_type ?? '0 AFG';
        $Land_Area = $filament->numeraha->Land_Area ?? '0 AFG';
        $north = $filament->numeraha->north ?? '0';
        $south = $filament->numeraha->south ?? '0';
        $east = $filament->numeraha->east ?? '0';
        $west = $filament->numeraha->west ?? '0';
        $total_price = $filament->total_price ?? '0 AFG';
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
        $html = view('pdf', compact(
            'numeraha_id',
            'customer_id',
            'customer',
            'father_name',
            'grand_father_name',
            'province',
            'tazkira',
            'village',
            'tazkira',
            'mobile_number',
            'job',
            'Customer_image',
            'responsable_name',
            'responsable_father_name',
            'responsable_grand_father_name',
            'responsable_province',
            'responsable_village',
            'responsable_tazkira',
            'responsable_mobile_number',
            'responsable_image',
            'responsable_job',
            'numera_id',
            'numera_type',
            'Land_Area',
            'north',
            'south',
            'east',
            'west',
            'total_price',
            'sharwali_tarifa_price',
            'date'
        ))->render();

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
        $grand_father_name = $filament->customer->grand_father_name ?? 'Unknown';
        $province = $filament->customer->province ?? 'Unknown';
        $village = $filament->customer->village ?? 'Unknown';
        $tazkira = $filament->customer->tazkira ?? 'Unknown';
        $mobile_number = $filament->customer->mobile_number ?? 'Unknown';
        $job = $filament->customer->job ?? 'Unknown';
        $Customer_image = $filament->customer->Customer_image ?? 'Unknown';
        $responsable_name = $filament->customer->responsable_name ?? 'Unknown';
        $responsable_father_name = $filament->customer->responsable_father_name ?? 'Unknown';
        $responsable_grand_father_name = $filament->customer->responsable_grand_father_name ?? 'Unknown';
        $responsable_province = $filament->customer->responsable_province ?? 'Unknown';
        $responsable_village = $filament->customer->responsable_village ?? 'Unknown';
        $responsable_tazkira = $filament->customer->responsable_tazkira ?? 'Unknown';
        $responsable_mobile_number = $filament->customer->responsable_mobile_number ?? 'Unknown';
        $responsable_image = $filament->customer->responsable_image ?? 'Unknown';
        $responsable_job = $filament->customer->responsable_job ?? 'Unknown';
        $responsable_ = $filament->customer->responsable_ ?? 'Unknown';
        //numerah Detail is started here

        $numera_id = $filament->numeraha->numera_id ?? '0 AFG';
        $numera_type = $filament->numeraha->numera_type ?? '0 AFG';
        $Land_Area = $filament->numeraha->Land_Area ?? '0 AFG';
        $north = $filament->numeraha->north ?? '0';
        $south = $filament->numeraha->south ?? '0';
        $east = $filament->numeraha->east ?? '0';
        $west = $filament->numeraha->west ?? '0';
        $total_price = $filament->total_price ?? '0 AFG';
        $sharwali_tarifa_price = $filament->numeraha->sharwali_tarifa_price ?? '0 AFG';
        $date = Carbon::now();

        // Initialize TCPDF
        $pdf = new Dompdf();
        $pdf = new TCPDF();

        // Set document information
        $pdf::SetAuthor('Your Name');
        $pdf::SetTitle('Persian PDF');

        // Set RTL language support if needed
        $pdf::setRTL(true);

        // Add a page
        $pdf::AddPage();
        // $pdf->set_option('defaultFont', 'Courier');
        // Set custom fonts
        $pdf::SetFont('Courier', '', 12); // Use Times New Roman

        // Render Blade template into HTML with data
        $html = view('numerahDocs', compact(
            'numeraha_id',
            'customer_id',
            'customer',
            'father_name',
            'grand_father_name',
            'province',
            'tazkira',
            'village',
            'tazkira',
            'mobile_number',
            'job',
            'Customer_image',
            'responsable_name',
            'responsable_father_name',
            'responsable_grand_father_name',
            'responsable_province',
            'responsable_village',
            'responsable_tazkira',
            'responsable_mobile_number',
            'responsable_image',
            'responsable_job',
            'numera_id',
            'numera_type',
            'Land_Area',
            'north',
            'south',
            'east',
            'west',
            'total_price',
            'sharwali_tarifa_price',
            'date'
        ))->render();

        // Pass the rendered HTML to TCPDF
        $pdf::writeHTML($html, true, false, true, false, '');

        // Output PDF as download
        return $pdf::Output('د نمری سند.pdf', 'D');

    }
}
