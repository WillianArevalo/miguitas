    @props(['options' => [], 'type' => '', 'rol' => 'user'])
    @foreach ($options as $value => $label)
        <li class="itemOption{{ $type }}{{--  @if ($rol == 'admin') dark:text-white dark:hover:bg-zinc-900 @endif --}} cursor-default truncate rounded-lg px-4 py-3 text-sm text-zinc-900 hover:bg-zinc-100"
            title="{{ $label }}" data-value="{{ $value }}" data-input="#{{ strtolower($type) }}">
            {{ $label }}
        </li>
    @endforeach
