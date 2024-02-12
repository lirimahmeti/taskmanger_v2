<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabelPrintSettings extends Model
{
    use HasFactory;

    protected $table = 'label_print_settings';

    protected $fillable = [
        'paper_height',
        'paper_width',
        'header_text_size',
        'body_text_size',
        'body_text_area_width',
        'body_text_area_height',
        'body_text_margin',
        'content_margin',
        'qrcode_size',
        'chosen',
        'header_height',
        'name',
    ];
}
