<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCodeModel extends Model
{
    protected $table = 'qr_codes';
    public $timestamps = false;

    protected $fillable = ['link', 'qr_code_path','scans_count','user_location'];
}
