@props(['headers' => [], 'striped' => false, 'hover' => true])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-200 rounded-xl overflow-hidden']) }}>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
            <tr class="border-b border-gray-200 bg-gray-50/60">
                <th class="pl-4 pr-2 py-3 w-8">
                    <x-forms.checkbox wire:model.live="selectAll" aria-label="Выбрать все" />
                </th>
                @foreach ($headers as $head)
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 whitespace-nowrap">
                        {{ $head }}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
