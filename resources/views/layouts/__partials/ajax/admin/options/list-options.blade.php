@if ($options->count() > 0)
    <ul class="flex w-full flex-col">
        @foreach ($options as $option)
            <li class="flex gap-2 rounded-lg px-4 py-2.5 text-sm text-zinc-900 hover:bg-zinc-100 dark:text-white dark:hover:bg-zinc-900"
                data-value="{{ $option->id }}">
                <div>
                    <x-input type="checkbox" value="{{ $option->id }}" name="options_checkbox"
                        data-name="{{ $option->value }}" data-option-id="{{ $optionParent->id }}" />
                </div>
                {{ $option->value }}
            </li>
        @endforeach
    </ul>
@else
    <x-paragraph>
        Sin opciones registradas
    </x-paragraph>
@endif
