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
        'url',
    ];

    public function transformerMappings()
    {
        return $this->hasMany(TransformerMapping::class, 'data_source_id');
    }

    /**
     * Fetch raw data from the given URL or Storage path.
     */
    public function getData()
    {
        $url = $this->url;

        // Handle Storage:: support
        if (Str::startsWith($url, 'storage:')) {
            // Format: storage:disk:path or storage:path (default disk)
            $parts = explode(':', $url, 3);
            if (count($parts) === 3) {
                $disk = $parts[1];
                $path = $parts[2];

                return Storage::disk($disk)->get($path);
            } else {
                $path = $parts[1] ?? '';

                return Storage::get($path);
            }
        }

        // Handle HTTP(S) URL
        if (Str::startsWith($url, ['http://', 'https://'])) {
            $response = Http::get($url);

            return $response->successful() ? $response->body() : null;
        }

        // Handle local file path (absolute or relative to App root)
        if (file_exists($url)) {
            return file_get_contents($url);
        }

        // Try relative to home if it starts with ~
        if (Str::startsWith($url, '~')) {
            $home = getenv('HOME');
            $path = str_replace('~', $home, $url);
            if (file_exists($path)) {
                return file_get_contents($path);
            }
        }

        return null;
    }
}
