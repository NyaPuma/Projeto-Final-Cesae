<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class SystemSetting extends Model
{
    protected $table = 'system_settings';
    protected $fillable = ['key', 'value'];
    public $timestamps = true;
}
