<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class BoqLine extends Model
{
    use HasFactory;
    protected $fillable = [
        'mitra_pendaftaran_id',
        'nama_lokasi',
        'sto',
        'sp_material',
        'sp_jasa',
        'sp_total',
        'rekon_material',
        'rekon_jasa',
        'rekon_total',
        'tambah_material',
        'tambah_jasa',
        'tambah_total',
        'kurang_material',
        'kurang_jasa',
        'kurang_total',
    ];
    protected $casts = [
        'sp_material' => 'double',
        'sp_jasa' => 'double',
        'sp_total' => 'double',
        'rekon_material' => 'double',
        'rekon_jasa' => 'double',
        'rekon_total' => 'double',
        'tambah_material' => 'double',
        'tambah_jasa' => 'double',
        'tambah_total' => 'double',
        'kurang_material' => 'double',
        'kurang_jasa' => 'double',
        'kurang_total' => 'double',
    ];
    public function mitraPendaftaran(): BelongsTo
    {
        return $this->belongsTo(MitraPendaftaran::class, 'mitra_pendaftaran_id');    }
    // Accessor untuk menghitung total otomatis jika tidak ada
    public function getSpTotalAttribute($value)
    {
        return $value ?? ($this->sp_material + $this->sp_jasa);
    }
    public function getRekonTotalAttribute($value)
    {
        return $value ?? ($this->rekon_material + $this->rekon_jasa);
    }
    public function getTambahTotalAttribute($value)
    {
        return $value ?? ($this->tambah_material + $this->tambah_jasa);
    }
    public function getKurangTotalAttribute($value)
    {
        return $value ?? ($this->kurang_material + $this->kurang_jasa);
    }
      /**
     * Get the mitra that owns this BOQ line
     */
    /**
     * Calculate totals automatically when saving
     */
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            // Auto calculate SP total
            $model->sp_total = ($model->sp_material ?? 0) + ($model->sp_jasa ?? 0);
            // Auto calculate Rekon total
            $model->rekon_total = ($model->rekon_material ?? 0) + ($model->rekon_jasa ?? 0);
            // Auto calculate Tambah total
            $model->tambah_total = ($model->tambah_material ?? 0) + ($model->tambah_jasa ?? 0);
            // Auto calculate Kurang total
            $model->kurang_total = ($model->kurang_material ?? 0) + ($model->kurang_jasa ?? 0);
        });
    }
    /**
     * Get net material amount (SP + Tambah - Kurang)
     */
    public function getNetMaterialAttribute()
    {
        return ($this->sp_material + $this->tambah_material) - $this->kurang_material;
    }
    /**
     * Get net jasa amount (SP + Tambah - Kurang)
     */
    public function getNetJasaAttribute()
    {
        return ($this->sp_jasa + $this->tambah_jasa) - $this->kurang_jasa;
    }
    /**
     * Get net total amount
     */
    public function getNetTotalAttribute()
    {
        return $this->net_material + $this->net_jasa;
    }
    /**
     * Scope to get BOQ lines for specific mitra
     */
    public function scopeForMitra($query, $mitraId)
    {
        return $query->where('mitra_pendaftaran_id', $mitraId);
    }
    /**
     * Scope to order by number
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('no')->orderBy('id');
    }
}
