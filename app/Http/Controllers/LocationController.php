<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function showImportForm()
    {
        return view('locations.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle);

        $imported = 0;
        $skipped = 0;
        $rowNumber = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;
            // Skip empty lines
            if (count(array_filter($row)) == 0) {
                $skipped++;
                continue;
            }
            // If row has more columns than header, trim it
            if (count($row) > count($header)) {
                $row = array_slice($row, 0, count($header));
            }
            // If row has fewer columns, pad with nulls
            if (count($row) < count($header)) {
                $row = array_pad($row, count($header), null);
            }
            $data = array_combine($header, $row);
            // Import even if location_name is missing, but location_id must exist
            if (!isset($data['location_id']) || $data['location_id'] === null || $data['location_id'] === '') {
                $skipped++;
                continue;
            }
            Location::updateOrCreate(
                ['location_id' => $data['location_id']],
                ['location_name' => $data['location_name'] ?? '']
            );
            $imported++;
        }
        fclose($handle);

        return redirect()->back()->with('success', "Imported: $imported, Skipped: $skipped");
    }
}
