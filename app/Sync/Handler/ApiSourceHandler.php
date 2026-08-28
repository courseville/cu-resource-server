<?php

namespace App\Sync\Handler;

use App\Models\DataSource;

interface ApiSourceHandler
{
    /**
     * Fetch and return this source's data as normalized rows.
     *
     * @return array<int, array<string, mixed>>
     */
    public function fetchData(DataSource $source): array;
}