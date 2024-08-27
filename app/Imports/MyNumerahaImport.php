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
                'Land_Area' => $row[0],
                'numera_id' => $row[1],
                'date' => $row[2],  // Cast to integer
                'numera_type' => $row[3],
            ]);
        }
    }
}
