<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConnectionController extends Controller
{
    public function check()
    {
        try {
            DB::connection()->getPdo();
            return view('check_connection', ['status' => 'Connected to the database successfully!']);
        } catch (\Exception $e) {
            return view('check_connection', ['status' => 'Database connection failed: ' . $e->getMessage()]);
        }
    }
}
