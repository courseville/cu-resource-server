<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DataSource extends Model
{
    use HasFactory;

    protected $table = 'data_sources';

    protected $fillable = [
        'name',
        'type',
        'url',
        'is_active',
        'last_synced_at',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_synced_at' => 'datetime',
        'order' => 'integer',
    ];

    public function imports()
    {
        return $this->hasMany(Import::class, 'data_source_id');
    }

    public function transformerMappings()
    {
        return $this->hasMany(TransformerMapping::class, 'data_source_id');
    }

    /**
     * Get the absolute file path for the source.
     */
    public function getFilePath(): ?string
    {
        $url = $this->url;

        // Handle Storage:: support
        if (Str::startsWith($url, 'storage:')) {
            $parts = explode(':', $url, 3);
            $disk = count($parts) === 3 ? $parts[1] : 'local';
            $path = count($parts) === 3 ? $parts[2] : ($parts[1] ?? '');

            return Storage::disk($disk)->path($path);
        }

        // Handle local file path
        if (file_exists($url)) {
            return realpath($url);
        }

        // Handle path with ~
        if (Str::startsWith($url, '~')) {
            $path = str_replace('~', getenv('HOME'), $url);
            if (file_exists($path)) {
                return realpath($path);
            }
        }

        return null;
    }

    /**
     * Fetch raw data from the given URL or Storage path.
     */
    public function getData()
    {
        $filePath = $this->getFilePath();

        if ($filePath && file_exists($filePath)) {
            return file_get_contents($filePath);
        }

        // Handle HTTP(S) URL
        if (Str::startsWith($this->url, ['http://', 'https://'])) {
            $response = Http::get($this->url);

            return $response->successful() ? $response->body() : null;
        }

        return null;
    }
}
