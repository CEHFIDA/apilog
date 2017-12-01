<?php

namespace Selfreliance\Apilog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Selfreliance\Apilog\Models\APIlog;

class ApiLogController extends Controller
{
	public function index(Request $request)
	{
		$info = [
			'token' => $request['token'],
			'status' => $request['status'],
			'method' => $request['method'],
			'ip' => $request['ip'],
			'data' => $request['data'],
			'url' => $request['url'],
			'answer' => $request['answer']
		];

		$logs = APILog::where('status', '!=', 201)->where(function ($query) use ($info){
			foreach($info as $key => $value)
			{
				if($value != '')
				{
					if(is_array($value))
					{
						$query->whereIn($key, $value);
					}
					else
					{
						$query->where($key, 'LIKE', $value);
					}
				}
			}
		})->orderBy('id', 'desc')->paginate(10);

		foreach($info as $key => $value)
		{
			$logs->appends([$key => $value]);
		}

		$statusCodes = APILog::distinct()->get(['status']);
		$methods = APILog::distinct()->get(['method']);

		return view('apilog::show')->with([
			'logs' => $logs,
			'token' => $info['token'],
			'status' => $info['status'],
			'method' => $info['method'],
			'ip' => $info['ip'],
			'data' => $info['data'],
			'url' => $info['url'],
			'answer' => $info['answer'],
			'statusCodes' => $statusCodes,
			'methods' => $methods
		]);
	}
}