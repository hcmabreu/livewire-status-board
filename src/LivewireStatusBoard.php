<?php

namespace Asantibanez\LivewireStatusBoard;

use Illuminate\Support\Collection;
use Livewire\Component;

/**
 * Class LivewireStatusBoard
 * @package Asantibanez\LivewireStatusBoard
 * @property boolean $sortable
 * @property boolean $sortableBetweenStatuses
 * @property string $statusBoardView
 * @property string $statusView
 * @property string $statusHeaderView
 * @property string $statusFooterView
 * @property string $recordView
 * @property string $recordContentView
 * @property string $sortableView
 * @property string $beforeStatusBoardView
 * @property string $afterStatusBoardView
 * @property string $ghostClass
 * @property boolean $recordClickEnabled
 */
class LivewireStatusBoard extends Component
{
    public $id;
    public $sortable;
    public $sortableBetweenStatuses;

    public $statusBoardView;
    public $statusView;
    public $statusHeaderView;
    public $statusFooterView;
    public $recordView;
    public $recordContentView;
    public $sortableView;
    public $beforeStatusBoardView;
    public $afterStatusBoardView;

    public $ghostClass;

    public $recordClickEnabled;

    public function mount($sortable = true,
                          $sortableBetweenStatuses = true,
                          $statusBoardView = null,
                          $statusView = null,
                          $statusHeaderView = null,
                          $statusFooterView = null,
                          $recordView = null,
                          $recordContentView = null,
                          $sortableView = null,
                          $beforeStatusBoardView = null,
                          $afterStatusBoardView = null,
                          $ghostClass = null,
                          $recordClickEnabled = false,
                          $extras = [])
    {
        $this->sortable = $sortable ?? false;
        $this->sortableBetweenStatuses = $sortableBetweenStatuses ?? false;

        $this->statusBoardView = $statusBoardView ?? 'livewire-status-board::status-board';
        $this->statusView = $statusView ?? 'livewire-status-board::status';
        $this->statusHeaderView = $statusHeaderView ?? 'livewire-status-board::status-header';
        $this->statusFooterView = $statusFooterView ?? 'livewire-status-board::status-footer';
        $this->recordView = $recordView ?? 'livewire-status-board::record';
        $this->recordContentView = $recordContentView ?? 'livewire-status-board::record-content';
        $this->sortableView = $sortableView ?? 'livewire-status-board::sortable';
        $this->beforeStatusBoardView = $beforeStatusBoardView ?? null;
        $this->afterStatusBoardView = $afterStatusBoardView ?? null;

        $this->ghostClass = $ghostClass ?? 'bg-indigo-100';

        $this->recordClickEnabled = $recordClickEnabled ?? false;

        $this->afterMount($extras);
    }

    public function afterMount($extras = [])
    {
        //
    }

    public function statuses() : Collection
    {
        return collect();
    }

    public function records() : Collection
    {
        return collect();
    }

    public function isRecordInStatus($record, $status)
    {
        return $record['status'] == $status['id'];
    }

    public function onStatusSorted($recordId, $statusId, $orderedIds)
    {
        //
    }

    public function onStatusChanged($recordId, $statusId, $fromOrderedIds, $toOrderedIds)
    {
        //
    }

    public function onRecordClick($recordId)
    {
        //
    }

    public function styles()
    {
        return [
            'wrapper' => 'w-full h-full flex space-x-2 overflow-x',
            'statusWrapper' => 'h-full flex-1',
            'status' => 'px-2 flex flex-col h-full',
            'statusHeader' => 'p-2 text-sm text-gray-700',
            'statusFooter' => '',
            'statusRecords' => 'space-y-2 flex-1 overflow-y-auto',
            'record' => 'p-2 cursor-pointer',
            'recordContent' => 'overflow-hidden rounded-xl border border-gray-200',
        ];
    }

    public function render()
    {
        $statuses = $this->statuses();

        $records = $this->records();

        $styles = $this->styles();

        $statuses = $statuses
            ->map(function ($status) use ($records) {
                $id =  $this->id ?? 'kanban';
                $status['group'] = $id;
                $status['statusRecordsId'] = "{$id}-{$status['id']}";
                $status['records'] = $records
                    ->filter(function ($record) use ($status) {
                        return $this->isRecordInStatus($record, $status);
                    });

                return $status;
            });

        return view($this->statusBoardView)
            ->with([
                'records' => $records,
                'statuses' => $statuses,
                'styles' => $styles,
            ]);
    }
}
