<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class ThemeSetting extends Model
{
    protected $table = 'theme_settings';

    protected $fillable = ['key', 'value'];

    public $timestamps = true;
}
