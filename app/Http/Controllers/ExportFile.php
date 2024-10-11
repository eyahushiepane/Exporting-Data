<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;

class ExportFile extends Controller
{
    public static function export(Request $request)
    {
        $employee_data = DB::table('employee_data')->get();

        if ($employee_data->isEmpty()) {
            return response()->json(['message' => 'No data available for export'], 404);
        }

        $filename = "employee_data-masterlist.csv";
        $filepath = "/Downloads/".$filename;

        $header = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"'
        ];

        $handle = fopen($filepath, 'w');
        fputcsv($handle, ['Set1', 'Set2','Set3', 'Set4', 'Set5', 'Set6','Set7', 'Set8','Set9', 'Set10','Set11', 'Set12', 'Set13']);

        foreach ($employee_data as $employee) {
            fputcsv($handle, [$employee->set1, $employee->set2, $employee->set3, $employee->set4, $employee->set5, $employee->set6, $employee->set7, $employee->set8, $employee->set9, $employee->set10, $employee->set11, $employee->set12, $employee->set13]);
        }

        fclose($handle);

        return response()->make('', 200, $header);
    }
}




