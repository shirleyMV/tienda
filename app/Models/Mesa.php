<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class Mesa extends Model
{
    protected $fillable = ['codigo', 'ubicacion', 'qr_url'];

    protected static function booted(): void
    {
        static::creating(function (Mesa $mesa) {
            // Si no se establece manualmente el código
            if (empty($mesa->codigo)) {
                $mesa->codigo = strtoupper(Str::random(6));
            }

            // Generar QR solo si no existe
            if (empty($mesa->qr_url)) {
                $url = route('mesa.menu', ['mesa' => $mesa->id]);

              $filename = 'mesa_' . uniqid() . '.svg';


                // Guardamos archivo QR temporal
               $qr = QrCode::format('svg')->size(300)->generate($url);

                Storage::disk('public')->put("qrs/{$filename}", $qr);
                $mesa->qr_url = "storage/qrs/{$filename}";
            }
        });
    }
}
