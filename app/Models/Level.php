<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_levels';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'level_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false; // Jika tabel tidak memiliki kolom created_at dan updated_at

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level_kode',
        'level_nama',
    ];

    // Tambahan kode program lainnya
}
