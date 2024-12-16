
{{-- Injected variables $record, $styles --}}
<ul
    id="{{ $record['id'] }}"
    @if($recordClickEnabled)
        wire:click="onRecordClick('{{ $record['id'] }}')"
    @endif
    class="{{ $styles['record'] }}">

    @include($recordContentView, [
        'record' => $record,
        'styles' => $styles,
    ])

</ul>
