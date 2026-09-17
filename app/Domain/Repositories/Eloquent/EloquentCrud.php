<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Eloquent;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final readonly class EloquentCrud
{
    public function __construct(private Model $model) {}

    /** Свежий запрос — точка расширения для специфичных выборок. */
    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    // ─────────── Чтение ───────────

    /** @return Collection<int, Model> */
    public function all(array $columns = ['*']): Collection
    {
        return $this->query()->get($columns);
    }

    public function find(int $id, array $columns = ['*']): ?Model
    {
        return $this->query()->find($id, $columns);
    }

    public function findOrFail(int $id, array $columns = ['*']): Model
    {
        return $this->query()->findOrFail($id, $columns);
    }

    public function findBy(string $column, mixed $value): ?Model
    {
        return $this->query()->where($column, $value)->first();
    }

    public function paginate(int $perPage = 20, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->query()->latest('id')->paginate($perPage, $columns);
    }

    public function count(): int
    {
        return $this->query()->count();
    }

    public function exists(int $id): bool
    {
        return $this->query()->whereKey($id)->exists();
    }

    // ─────────── Запись ───────────

    /** @param array<string, mixed> $data */
    public function create(array $data): Model
    {
        return $this->query()->create($data);
    }

    /** @param array<string, mixed> $data */
    public function update(int $id, array $data): ?Model
    {
        $record = $this->find($id);
        $record?->update($data);

        return $record;
    }

    public function delete(int $id): bool
    {
        return $this->query()->whereKey($id)->delete() > 0;
    }

    /** @param array<int|string> $ids */
    public function deleteMany(array $ids): int
    {
        if (empty($ids)) {
            return 0;
        }

        return $this->query()->whereKey($ids)->delete();
    }
}
