<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Contracts;

use App\Models\Company;
use Illuminate\Support\Collection;

interface BaseRepository
{
    /** @return Collection<int, Company> */
    public function all(): Collection;

    public function find(int $id): ?Company;

    public function findOrFail(int $id): Company;

    /** @param array<string, mixed> $data */
    public function create(array $data): Company;

    /** @param array<string, mixed> $data */
    public function update(int $id, array $data): ?Company;

    public function delete(int $id): bool;

    /** @param array<int|string> $ids */
    public function deleteMany(array $ids): int;
}
