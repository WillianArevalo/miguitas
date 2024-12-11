    @props(['options' => [], 'type' => ''])
    @foreach ($options as $value => $label)
        <li class="itemOption{{ $type }} cursor-default truncate rounded-lg px-4 py-3 text-sm text-zinc-900 hover:bg-zinc-100"
            title="{{ $label }}" data-value="{{ $value }}" data-input="#municipio">
            {{ $label }}
        </li>
    @endforeach
