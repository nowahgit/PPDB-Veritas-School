<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Prestasi;
use App\Models\Berkas;
use App\Models\Seleksi; // pastikan ada di atas



class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'no_hp',
        'nisn_pendaftar',
        'nama_pendaftar',
        'jenis_kelamin',
        'tanggallahir_pendaftar',
        'alamat_pendaftar',
        'agama',
        'prestasi',
        'prestasi_level',        // BARU
        'nama_ortu',
        'pekerjaan_ortu',
        'no_hp_ortu',
        'alamat_ortu',
        'nilai_smt1',
        'nilai_smt2',
        'nilai_smt3',
        'nilai_smt4',
        'nilai_smt5',
        'rata_rata',          // TAMBAHKAN
        'poin_prestasi',      // TAMBAHKAN
        'nilai_total',        // TAMBAHKAN
        'berkas_approved',       // BARU
        'prestasi_approved',     // BARU
        'status',                // BARU
        'identitas_locked',
        'identitas_submitted_at',
        'berkas_locked',           // TAMBAHKAN
        'berkas_submitted_at',     // TAMBAHKAN
        'prestasi_locked',         // TAMBAHKAN
        'prestasi_submitted_at',   // TAMBAHKAN 
        'periode_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'tanggallahir_pendaftar' => 'date',
            'berkas_approved' => 'boolean',
            'prestasi_approved' => 'boolean',
            'identitas_locked' => 'boolean',
            'identitas_submitted_at' => 'datetime',
            'berkas_locked' => 'boolean',        // TAMBAHKAN
            'berkas_submitted_at' => 'datetime', // TAMBAHKAN
            'prestasi_locked' => 'boolean',      // TAMBAHKAN
            'prestasi_submitted_at' => 'datetime', // TAMBAHKAN,
            // JANGAN tambahkan 'password' => 'hashed' di sini!
        ];
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeSeleksi::class, 'periode_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }


    /**
     * Relationship dengan Prestasi
     */
    public function prestasis()
    {
        return $this->hasMany(Prestasi::class);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'ADMIN';
    }

    /**
     * Check if user is pendaftar
     */
    public function isPendaftar(): bool
    {
        return $this->role === 'PENDAFTAR';
    }

    /**
     * Calculate average score
     */
    public function getAverageScore(): float
    {
        if (
            !$this->nilai_smt1 || !$this->nilai_smt2 || !$this->nilai_smt3 ||
            !$this->nilai_smt4 || !$this->nilai_smt5
        ) {
            return 0;
        }

        return round(($this->nilai_smt1 + $this->nilai_smt2 + $this->nilai_smt3 +
            $this->nilai_smt4 + $this->nilai_smt5) / 5, 2);
    }

    /**
     * Get bonus score from prestasi
     */
    public function getBonusScore(array $bonusSettings): float
    {
        if (!$this->prestasi || $this->prestasi === '-' || !$this->prestasi_approved) {
            return 0;
        }

        $level = strtolower($this->prestasi_level ?? '');

        return match ($level) {
            'internasional' => $bonusSettings['internasional'] ?? 10,
            'nasional' => $bonusSettings['nasional'] ?? 7,
            'provinsi' => $bonusSettings['provinsi'] ?? 5,
            'kota', 'kabupaten' => $bonusSettings['kota'] ?? 3,
            'sekolah' => $bonusSettings['sekolah'] ?? 1,
            default => 0,
        };
    }

    /**
     * Get total score (average + bonus)
     */
    public function getTotalScore(array $bonusSettings): float
    {
        return round($this->getAverageScore() + $this->getBonusScore($bonusSettings), 2);
    }

    /**
     * Scope untuk filter pendaftar
     */
    public function scopePendaftar($query)
    {
        return $query->where('role', 'PENDAFTAR');
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeWithStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter yang sudah diverifikasi berkasnya
     */
    public function scopeBerkasVerified($query)
    {
        return $query->where('berkas_approved', true);
    }

    /**
     * Scope untuk filter yang sudah diverifikasi prestasinya
     */
    public function scopePrestasiVerified($query)
    {
        return $query->where('prestasi_approved', true);
    }
    public function berkas()
    {
        return $this->hasOne(Berkas::class);
    }

    public function adminData()
    {
        return $this->hasOne(\App\Models\Admin::class, 'user_id', 'id');
    }

    public function seleksi()
    {
        return $this->hasOne(Seleksi::class, 'user_id', 'id');
    }

}