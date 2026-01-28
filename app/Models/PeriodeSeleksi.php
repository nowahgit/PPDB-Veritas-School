<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PeriodeSeleksi extends Model
{
    use HasFactory;

    protected $table = 'periode_seleksi';

    protected $fillable = [
        'nama_periode',
        'kuota',
        'tanggal_mulai',
        'tanggal_selesai',
        'batas_lulus',
        'status',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'batas_lulus' => 'decimal:2',
        'kuota' => 'integer'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'periode_id');
    }

    public function seleksis()
    {
        return $this->hasMany(Seleksi::class, 'periode_id');
    }

 
    public function isAktif(): bool
{
    return $this->status === 'aktif'
        && Carbon::now()->between(
            $this->tanggal_mulai->startOfDay(),
            $this->tanggal_selesai->endOfDay()
        );
}


 
    public function scopeAktif($query)
{
    return $query->where('status', 'aktif')
        ->whereDate('tanggal_mulai', '<=', Carbon::today())
        ->whereDate('tanggal_selesai', '>=', Carbon::today());
}



    public function jumlahPeserta(): int
    {
        return $this->users()->where('role', 'PENDAFTAR')->count();
    }


    public function jumlahLulus(): int
    {
        return $this->users()
                    ->where('role', 'PENDAFTAR')
                    ->where('status_seleksi', 'Lulus')
                    ->count();
    }

    public function jumlahTidakLulus(): int
    {
        return $this->users()
                    ->where('role', 'PENDAFTAR')
                    ->where('status_seleksi', 'Tidak Lulus')
                    ->count();
    }

    public function jumlahBelumDiseleksi(): int
    {
        return $this->users()
                    ->where('role', 'PENDAFTAR')
                    ->where('status_seleksi', 'Belum Diseleksi')
                    ->count();
    }


    public function isKuotaPenuh(): bool
    {
        return $this->jumlahLulus() >= $this->kuota;
    }


    public function sisaKuota(): int
    {
        return max(0, $this->kuota - $this->jumlahLulus());
    }

   public function isSudahLewat(): bool
{
    return Carbon::now()->gt($this->tanggal_selesai->endOfDay());
}

  public function isBelumDimulai(): bool
{
    return Carbon::now()->lt($this->tanggal_mulai->startOfDay());
}


    public function getStatusBadge(): string
{
    $status = $this->getStatusReal();

    return match ($status) {
        'aktif' => '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Aktif</span>',
        'selesai' => '<span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">Selesai</span>',
        'draft' => '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">Draft</span>',
        default => '<span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">'.ucfirst($status).'</span>',
    };
}


    public function getDurasiHari(): int
    {
        return $this->tanggal_mulai->diffInDays($this->tanggal_selesai);
    }

    public function getSisaHari(): int
    {
        if ($this->isSudahLewat()) {
            return 0;
        }
        
        if ($this->isBelumDimulai()) {
            return $this->tanggal_mulai->diffInDays(Carbon::now());
        }
        
        return Carbon::now()->diffInDays($this->tanggal_selesai);
    }

    public function getStatusReal(): string
{
    if ($this->isSudahLewat()) return 'selesai';
    if ($this->isBelumDimulai()) return 'draft';
    if ($this->isAktif()) return 'aktif';

    return $this->status;
}

}