<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Numeraha;

class MyNumerahaImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            // Assuming the columns in your CSV match these model attributes
            Numeraha::create([
                'numero_number' => $row[0],
                'save_number' => $row[1],
                'date' => $row[2],
                'numera_price' => $row[3],
                'sharwali_tarifa_price' => $row[4],
                'Customer_image' => $row[5],
                'documents' => $row[6],
                'created_at' => $row[7],  // Ensure this is a valid datetime format
                'updated_at' => $row[8],  // Ensure this is a valid datetime format
                'customer_id' => (int) $row[9],  // Cast to integer
                'numera_type' => $row[10],
            ]);
        }
    }
}
