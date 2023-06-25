<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DataController extends Controller
{
    public function showUploadForm()
    {
        return view('upload-csv');
    }

    public function uploadCsv(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        // Get the uploaded file
        $file = $request->file('csv_file');

        // Process the CSV file
        $rows = array_map('str_getcsv', file($file->getPathname()));
        $headerRow = array_shift($rows);

        return view('confirm-columns', compact('headerRow', 'rows'));
    }

    public function saveData(Request $request)
	{
		$columnMapping = $request->input('column_mapping');
		
		$user = Auth::user();
		// Get the rows from the request
		$rows = $request->input('rows');
		$rows = json_decode($rows, true);
		// dd($rows, $columnMapping);
		
		$savedRecords = [];
		foreach ($rows as $row) {
			$data = new Data();

			$data->user_id = $user->id;
			$data->column1 = $row[$columnMapping[0]];
			$data->column2 = $row[$columnMapping[1]];
			$data->column3 = $row[$columnMapping[2]];
			$data->column4 = $row[$columnMapping[3]];
			$data->column5 = $row[$columnMapping[4]];

			$data->save();

			$savedRecords[] = $data;
		}

		

		$message = count($savedRecords) . ' records saved.';
		$message .= ' List of records for user ' . $user->name . ':';
		
		foreach ($savedRecords as $record) {
			$message .= '<br>' . $record->column1 . ', ' . $record->column2 . ', ' . $record->column3 . ', ' . $record->column4 . ', ' . $record->column5;
		}
		
		Session::flash('success', $message);
		return redirect('/upload-csv');
		// return Redirect::back()->with('success', $message);
	}

}
