<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Company;

use App\Models\Company;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

final class CompanyForm extends Form
{
    public ?Company $company = null;

    public string $name = '';

    public string $inn = '';

    public ?TemporaryUploadedFile $logo = null;

    public function setCompany(Company $company): void
    {
        $this->company = $company;

        $this->name = $company->name;
        $this->inn = $company->inn;
        $this->logo = $company->logo;
    }


    public function save(): void
    {
        $this->validate();

        $company = Company::make($this->pull(['name', 'inn']));

        if ($this->logo) {
            $this->logo->store(path: 'companies');
            $company->fill(['logo' => $this->logo->hashName()]);
        }

        $company->save();
    }

    public function update(): void
    {
        $this->validate();

        if ($this->logo) {
            $this->logo->store(path: 'companies');
            $this->company->fill(['logo' => $this->logo->hashName()]);
        }

        $this->company->update($this->pull(['name', 'inn']));
    }

    public function delete()
    {

    }

    protected function rules(): array
    {
        $uniqueRule  = $this->company
            ? Rule::unique('companies', 'inn')->ignore($this->company->id)
            : 'unique:companies,inn';

        return [
            'name' => ['required', 'string', 'min:3'],
            'inn' => ['required', 'string', 'regex:/^[1-9]\d{9}(\d{2})?$/', $uniqueRule],
            'logo' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:512'],
        ];
    }
}
