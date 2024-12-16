
{{-- Injected variables $record, $styles --}}
<li class="{{ $styles['recordContent'] }}">
    <div class="flex items-center gap-x-2 border-b border-gray-900/5 bg-gray-50 p-2">
      <div class="text-sm/6 font-medium text-gray-900">{{ $record['title'] }}</div>
    </div>

    @if(isset($record['content']) && is_array($record['content']) && count($record['content']) > 0)
        <dl class="-my-3 divide-y divide-gray-100 px-2 py-2 text-sm/6">
          @foreach($record['content'] as $item)
              <div class="flex justify-between gap-x-4 py-2">
                <dt class="text-gray-500text-sm">{{ $item['title'] ?? '-' }}</dt>
                <dd class="text-gray-700">{{ $item['value'] }}</dd>
              </div>
          @endforeach
        </dl>
    @endif
  </li>
