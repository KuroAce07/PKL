<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DPA extends Model
{
    protected $table = 'dpa';
    protected $fillable = [
        'id_dpa',
        'tahun',
        'daerah',
        'kode_urusan',
        'nama_urusan',
        'kode_bidang_urusan',
        'nama_bidang_urusan',
        'kode_skpd',
        'nama_skpd',
        'kode_sub_skpd',
        'nama_sub_skpd',
        'kode_program',
        'nama_program',
        'kode_kegiatan',
        'nama_kegiatan',
        'kode_sub_kegiatan',
        'nama_sub_kegiatan',
        'kode_akun',
        'nama_akun',
        'nilai_rincian',
        'total_rak',
        'bulan_1',
        'bulan_2',
        'bulan_3',
        'bulan_4',
        'bulan_5',
        'bulan_6',
        'bulan_7',
        'bulan_8',
        'bulan_9',
        'bulan_10',
        'bulan_11',
        'bulan_12',
        'tipe',
    ];

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pejabatPengadaanUser()
    {
        return $this->belongsTo(User::class, 'user_id2');
    }

    public function pembantupptkUsers()
    {
        return $this->belongsTo(User::class, 'user_id3');
    }

    public function bendaharaUsers()
    {
        return $this->belongsTo(User::class, 'user_id4');
    }

    public function dokumenKontraks()
    {
        return $this->hasMany(DokumenKontrak::class, 'dpa_id');
    }

    public function dokumenJustifikasis()
    {
        return $this->hasMany(DokumenJustifikasi::class, 'dpa_id');
    }

    public function epurchasings()
    {
        return $this->hasMany(EPurchasing::class, 'dpa_id');
    }
    
    public function dokumenPendukungs()
    {
        return $this->hasMany(DokumenPendukung::class, 'dpa_id');
    }
    
    public function basts()
    {
        return $this->hasMany(Bast::class, 'dpa_id');
    }

    public function bap()
    {
        return $this->hasMany(Bap::class, 'dpa_id');
    }

    public function baph()
    {
        return $this->hasMany(Baph::class, 'dpa_id');
    }

    public function pilihrekanan()
    {
        return $this->hasMany(PilihRekanan::class, 'dpa_id');
    }

    public function bukti()
    {
        return $this->hasMany(Bukti::class, 'dpa_id');
    }

    public function surat()
    {
        return $this->hasMany(Surat::class, 'dpa_id');
    }

    public function dokumenKontrakspk()
    {
        return $this->hasMany(DokumenKontrakSPK::class, 'dpa_id');
    }

    public function suratperjanjian()
    {
        return $this->hasMany(SuratPerjanjian::class, 'dpa_id');
    }

    public function risalahkontrak()
    {
        return $this->hasMany(RisalahKontrak::class, 'dpa_id');
    }

    public function npwp()
    {
        return $this->hasMany(NPWP::class, 'dpa_id');
    }

    public function buku()
    {
        return $this->hasMany(Buku::class, 'dpa_id');
    }

    public function nib()
    {
        return $this->hasMany(NIB::class, 'dpa_id');
    }
}
