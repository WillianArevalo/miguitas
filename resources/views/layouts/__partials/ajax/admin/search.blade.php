@foreach ($results as $result)
    <li>
        <a href="{{ $result['url'] }}" class="text-zinc-900 dark:text-white">{{ $result['title'] }}</a>
    </li>
@endforeach
