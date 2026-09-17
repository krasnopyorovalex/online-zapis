<?php

declare(strict_types=1);

use App\Domain\Repositories\Contracts\CompanyRepositoryInterface;
use App\Livewire\Forms\Company\CompanyForm;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    public CompanyForm $form;

    public function save(): void
    {
        $this->form->save();

        $this->dispatch('changed');
    }
};
?>

<x-dashboard.modal name="company-form" :title="$this->form->company ? 'Редактировать компанию' : 'Новая компания'"
                   maxWidth="lg" :dismissible="false">

    <form wire:submit="save" id="company-form-el" class="space-y-4">
        <x-forms.input-text wire:model="form.name" name="form.name" label="Название" placeholder="ООО «Красбер»"/>
        <x-forms.input-text wire:model="form.inn" name="form.inn" label="ИНН" placeholder="1054502123"/>
    </form>

    <x-slot:footer>
        <x-forms.button variant="ghost" x-on:click="$dispatch('close-modal', { name: 'company-form' })">
            Отмена
        </x-forms.button>

        <x-forms.button type="submit" form="company-form-el" wire:loading.attr="disabled" wire:target="save">
            <svg wire:loading wire:target="save" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v3a5 5 0 00-5 5H4z"/>
            </svg>
            <span wire:loading.remove wire:target="save">
                    {{ $this->form->company ? 'Сохранить' : 'Создать' }}
                </span>
            <span wire:loading wire:target="save">Сохранение…</span>
        </x-forms.button>
    </x-slot:footer>
</x-dashboard.modal>
