<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Contracts;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CompanyRepositoryInterface extends BaseRepository
{
    public function paginate(int $perPage = 20): LengthAwarePaginator;

    /** @return Collection<int, Company> */
    public function findActive(): Collection;
}
