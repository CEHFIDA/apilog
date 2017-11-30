<?php

namespace Selfreliance\Apilog\Models;

use Illuminate\Database\Eloquent\Model;

class APILog extends Model
{
    protected $table = 'api_logs';

    protected $fillable = [
      'token', 'method', 'ip', 'url', 'data', 'status', 'answer'
    ];
}