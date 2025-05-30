<?php

namespace App\Http\Livewire;

use App\Exports\CustomExport;
use App\Models\Batch;
use App\Models\Zoom;
use Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class ZoomTable extends DataTableComponent
{

    protected $model = Zoom::class;
    public $counter = 1;
    public function mount()
    {
        $this->dispatchBrowserEvent('table-refreshed');
    }

    public function configure(): void
    {
        $this->counter = 1;
        $this->setFilterPillsStatus(false);

        $this->setFiltersDisabled();
        $this->setBulkActionsDisabled();
        $this->setColumnSelectDisabled();

        $this->setPrimaryKey('id')

            ->setDefaultSort('id', 'desc')
            ->setEmptyMessage('No Result Found')
            ->setTableAttributes([
                'id' => 'source-table',
            ])
            ->setBulkActions([
                'exportSelected' => 'Export',
            ])
            ->setConfigurableAreas([
                'toolbar-right-end' => 'content.rapasoft.add-button',
            ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Actions')
                ->label(function ($row, Column $column) {
                    $delete_route = route('admin.zooms.destroy', $row->id);
                    $edit_route = route('admin.zooms.edit', $row->id);
                    $edit_callback = 'setValue';
                    $modal = '#edit-zoom-modal';
                    return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
                }),
            Column::make('SrNo.', 'id')
                ->format(function ($value, $row, Column $column) {
                    return (($this->page - 1) * $this->getPerPage()) + ($this->counter++);
                })
                ->html(),
            Column::make('link')
                ->searchable(),
            Column::make('batch', 'batch.title')
                ->sortable(),
            Column::make('Created at', 'created_at')
                ->format(function ($value) {
                    return '<span class="badge badge-light-success">' . $value . '</span>';
                })
                ->html()
                ->collapseOnTablet()
                ->sortable(),
            Column::make('Updated at', 'updated_at')
                ->format(function ($value) {
                    return '<span class="badge badge-light-success">' . $value . '</span>';
                })
                ->html()
                ->collapseOnTablet()
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options([
                    '' => 'All',
                    'active' => 'Active',
                    'blocked' => 'Blocked',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('status', $value);
                }),
        ];
    }

    public function builder(): Builder
    {
        $modal = Zoom::query();
        $modal->with(['batch']);
        return $modal;
    }

    public function refresh(): void
    {

    }
    public function status($type)
    {
        $this->setFilter('status', $type);
    }

    public function exportSelected()
    {
        $modelData = new Zoom();
        return Excel::download(new CustomExport($this->getSelected(), $modelData), 'sources.xlsx');
    }
}
