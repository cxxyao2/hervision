<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\MonthlyOutput;

class MonthlyOutputController extends Controller
{
    public function __construct()
    {
      // $this->middleware('auth');
    }

    public function index(Request $request ,$year)
    {
        if (!empty($year)) {
            switch($year)
            {
                case 'all':
                    $data = MonthlyOutput::where('yearname', '>=', '2018')
                    ->orderBy('yearname', 'monthname')
                    ->get();
                break;
                default:
                    $data = MonthlyOutput::where('yearname',$year)
                    ->orderBy('yearname', 'monthname')
                    ->get();
            }
            return response($data, 200);
        }
        return response('no data', 200);

    }
}
