<?php

namespace Selfreliance\Apilog\Models;

use Illuminate\Database\Eloquent\Model;

class APILog extends Model
{
    protected $table = 'api_logs';

    protected $fillable = [
      'method', 'ip', 'token', 'url', 'data', 'status', 'answer'
    ];
}