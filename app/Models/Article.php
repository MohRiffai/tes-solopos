<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Nama tabel (opsional kalau nama model ≠ nama tabel)
    protected $table = 'posts';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'title',
        'content',
        'published_at',
        'user_id',
    ];

    public function getExcerpt($length = 100)
    {
        // Memotong konten artikel menjadi 100 karakter (atau jumlah yang ditentukan)
        return substr(strip_tags($this->content), 0, $length) . '...';
    }

    // Format tanggal
    protected $casts = [
        'published_at' => 'datetime',
    ];
    
    // Relasi ke User (Article milik satu User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
