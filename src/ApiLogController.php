<?php

namespace Selfreliance\Apilog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Selfreliance\Apilog\Models\APIlog;

class ApiLogController extends Controller
{
	public function index(Request $request)
	{
		$statusCode = $request->input('status_code');
		$method = $request->input('method');
		$search = $request->input('search');

		$logs = APILog::where('status', '!=', 201)->where(function ($query) use ($statusCode){
			if($statusCode != '')
			{
				$query->where('status', $statusCode);
			}
		})->where(function($query) use ($method){
			if($method != '')
			{
				$query->where('method', $method);
			}
		})->where(function($query) use ($search){
			if($search != '')
			{
				$query->where('id', 'LIKE', $search)
				->orWhere('ip', 'LIKE', $search)
				->orWhere('url', 'LIKE', $search)
				->orWhere('data', 'LIKE', $search)
				->orWhere('answer', 'LIKE', $search);
			}
		})->orderBy('id', 'desc')->paginate(10);

		$logs->appends(['status_code' => $statusCode]);
		$logs->appends(['method' => $method]);
		$logs->appends(['search' => $search]);

		return view('apilog::show')->with([
			'logs' => $logs,
			'search' => $search
		]);
	}
}