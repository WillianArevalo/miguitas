    @props(['options' => [], 'type' => '', 'rol' => 'user'])
    @foreach ($options as $value => $label)
        <li class="itemOption{{ $type }}{{--  @if ($rol == 'admin') dark:text-white dark:hover:bg-zinc-900 @endif --}} cursor-default truncate rounded-xl px-4 py-2.5 font-din-r text-sm text-zinc-700 hover:bg-zinc-100 md:text-base"
            title="{{ $label }}" data-value="{{ $value }}" data-input="#{{ strtolower($type) }}">
            {{ $label }}
        </li>
    @endforeach
