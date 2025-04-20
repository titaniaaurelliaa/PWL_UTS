<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FilmModel extends Model
{
    use HasFactory;

    protected $table = "m_film";
    protected $primaryKey = "film_id";
    protected $fillable = [
        'kategori_id',
        'film_kode',
        'film_nama',
        'harga_jual'
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }
}
