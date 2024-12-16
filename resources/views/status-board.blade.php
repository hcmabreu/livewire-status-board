<div>
    <div>
        @includeIf($beforeStatusBoardView)
    </div>

    <div class="overflow-y-auto">
        <div class="{{ $styles['wrapper'] }}" style="min-width: 960px;">
            @foreach($statuses as $status)
                @include($statusView, [
                    'status' => $status
                ])
            @endforeach
        </div>
    </div>

    <div>
        @includeIf($afterStatusBoardView)
    </div>

    <div wire:ignore>
        @includeWhen($sortable, 'livewire-status-board::sortable', [
            'sortable' => $sortable,
            'sortableBetweenStatuses' => $sortableBetweenStatuses,
        ])
    </div>
</div>
