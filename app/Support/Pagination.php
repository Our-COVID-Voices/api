<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Config;

class Pagination
{
    /**
     * @param int|null $perPage
     * @return int
     */
    public function perPage(int $perPage = null): int
    {
        $perPage = $perPage ?? Config::get('our_covid_voices.pagination.default');
        $perPage = max($perPage, 1);
        $perPage = min($perPage, Config::get('our_covid_voices.pagination.max'));

        return $perPage;
    }
}
