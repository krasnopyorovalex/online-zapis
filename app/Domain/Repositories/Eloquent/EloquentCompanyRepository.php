<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Eloquent;

use App\Domain\Repositories\Contracts\CompanyRepositoryInterface;
use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class EloquentCompanyRepository implements CompanyRepositoryInterface
{
    private EloquentCrud $crud;

    public function __construct(Company $model)
    {
        $this->crud = new EloquentCrud($model);
    }

    /** @return Collection<int, Company> */
    public function all(): Collection
    {
        return $this->crud->all();
    }

    public function find(int $id): ?Company
    {
        /** @var Company|null $company */
        $company = $this->crud->find($id);
        return $company;
    }

    public function findOrFail(int $id): Company
    {
        /** @var Company $company */
        $company = $this->crud->findOrFail($id);
        return $company;
    }

    public function create(array $data): Company
    {
        /** @var Company $company */
        $company = $this->crud->create($data);
        return $company;
    }

    public function update(int $id, array $data): ?Company
    {
        /** @var Company|null $company */
        $company = $this->crud->update($id, $data);
        return $company;
    }

    public function delete(int $id): bool
    {
        return $this->crud->delete($id);
    }

    public function deleteMany(array $ids): int
    {
        return $this->crud->deleteMany($ids);
    }

    public function paginate(int $perPage = 20): LengthAwarePaginator
    {
        return $this->crud->paginate($perPage);
    }

    public function findActive(): Collection
    {
        return $this->crud->query()->where('is_active', true)->get();
    }
}
