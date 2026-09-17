<?php

declare(strict_types=1);

use App\Domain\Repositories\Contracts\BaseRepository;
use App\Domain\Repositories\Contracts\CompanyRepositoryInterface;
use App\Livewire\Traits\Groupable;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {

    use WithPagination, Groupable;

    public function boot(CompanyRepositoryInterface $repository): void
    {
        $this->repository = $repository;
    }

    #[On('changed')]
    public function refresh(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function collection(): LengthAwarePaginator|array
    {
        return $this->repository->paginate();
    }
};
?>

<div class="flex flex-col gap-3">

    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">Компании</h1>
        </div>
        <x-forms.button wire:click="$dispatch('open-modal', { name: 'company-form' })" icon="M12 4.5v15m7.5-7.5h-15">
            Добавить
        </x-forms.button>
    </div>

    <x-tables.table :headers="['ID', 'Название', 'ИНН', 'Статус', 'Обновлена', '']">
        @forelse ($this->collection as $company)
            <tr wire:key="{{ $company->id }}"
                class="transition-colors {{ in_array((string) $company->id, $selected, true) ? 'bg-gray-100' : 'hover:bg-gray-100' }}">
                <td class="pl-4 pr-2 py-3 w-8">
                    <x-forms.checkbox wire:model.live="selected" value="{{ $company->id }}"
                                      aria-label="Выбрать {{ $company->name }}"/>
                </td>
                <td class="px-4 py-3 text-gray-500 tabular-nums">{{ $loop->index + 1 }}</td>
                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ $company->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $company->inn }}</td>
                <td class="px-4 py-3">
                    <x-tables.badge :color="$company->is_active ? 'success' : 'gray'">
                        {{ $company->is_active ? 'Активен' : 'Отключён' }}
                    </x-tables.badge>
                </td>
                <td class="px-4 py-3 text-gray-600">{{ $company->updated_at->diffForHumans() }}</td>
                <td class="px-4 py-3 text-right">
                <td class="px-4 py-3 text-center">
                    <div
                        class="inline-flex items-center justify-end gap-0.5 px-2 py-0.5 rounded-full text-xs font-medium ring-1 ring-inset bg-gray-100 text-gray-700 ring-gray-200">
                        {{-- Изменить --}}
                        <x-tables.button-row label="Изменить компанию">
                            <x-icons.edit/>
                        </x-tables.button-row>

                        {{-- Удалить --}}
                        <x-tables.button-row variant="danger" label="Удалить" wire:click="delete({{ $company->id }})"
                                             wire:confirm="Удалить компанию?">
                            <x-icons.remove/>
                        </x-tables.button-row>
                    </div>
                </td>
            </tr>
        @empty
            <x-tables.table-empty-placeholder/>
        @endforelse
    </x-tables.table>

    <div class="mt-4">
        {{ $this->collection->links() }}
    </div>

    <livewire:company.form/>
    <x-tables.table-group-actions/>
</div>
