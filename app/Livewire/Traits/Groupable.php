<?php

declare(strict_types=1);

namespace App\Livewire\Traits;

use App\Domain\Repositories\Contracts\BaseRepository;

trait Groupable
{
    /** @var array<string> */
    public array $selected = [];

    public bool $selectAll = false;

    private BaseRepository $repository;

    public function updatedSelectAll(bool $value): void
    {
        $this->selected = $value
            ? $this->collection->pluck('id')->map(fn($id) => (string)$id)->all()
            : [];
    }

    public function updatedSelected(): void
    {
        $total = $this->collection->count();
        $this->selectAll = $total > 0 && count($this->selected) === $total;
    }

    public function groupDelete(): void
    {
        $this->repository->deleteMany($this->selected);

        $this->selected = [];
        $this->selectAll = false;
    }

    public function delete(int $id): void
    {
        $this->selected = array_values(array_diff($this->selected, [(string)$id]));

        $this->repository->delete($id);

        $this->resetPage();
    }
}
