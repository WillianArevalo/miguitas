@if ($options->count() > 0)
    <div class="flex w-full flex-col gap-4">
        @foreach ($options as $option)
            <div class="flex items-start justify-between">
                <div class="flex flex-1 flex-col justify-center gap-2">
                    <label for="{{ $option->name }}" class="flex items-center gap-2">
                        <span class="text-sm text-zinc-500 dark:text-zinc-300">
                            {{ $option->name }}
                        </span>
                    </label>
                </div>
                <div class="flex flex-1 items-center justify-end gap-2">
                    <x-button type="button" typeButton="secondary" size="small" text="Agregar opciones" icon="plus"
                        data-modal-target="addOptionValue" class="showModalOptionValue"
                        data-modal-toggle="addOptionValue" data-container="#previewOptions-{{ $option->id }}"
                        data-id="{{ $option->id }}" />
                </div>
            </div>
            <div id="previewOptions-{{ $option->id }}" class="flex gap-2">
            </div>
        @endforeach
    </div>
    <div id="hiddenOptionsContainer"></div>
@else
    <x-paragraph>
        Sin opciones registradas
    </x-paragraph>
@endif
