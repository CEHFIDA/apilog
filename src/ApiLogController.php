<?php

namespace Selfreliance\Apilog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Selfreliance\Apilog\Models\APIlog;

class ApiLogController extends Controller
{
	public function index()
	{
		/*
			Start development
		*/
		return view('apilog::show');
	}
}