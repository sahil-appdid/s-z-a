<?php
namespace App\Http\Livewire;

use App\Exports\CustomExport;
use App\Models\Batch;
use Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class BatchTable extends DataTableComponent
{
    protected $model = Batch::class;
    public $counter  = 1;
    public function mount()
    {
        $this->dispatchBrowserEvent('table-refreshed');
    }

    public function configure(): void
    {
        $this->counter = 1;
        $this->setPrimaryKey('id');
        $this->setFilterPillsStatus(false);

        $this->setFiltersDisabled();
        $this->setBulkActionsDisabled();
        $this->setColumnSelectDisabled();

        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc')
            ->setEmptyMessage('No Result Found')
            ->setTableAttributes([
                'id' => 'batch-table',
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
                    $delete_route  = route('admin.batches.destroy', $row->id);
                    $edit_route    = route('admin.batches.edit', $row->id);
                    $edit_callback = 'setValue';
                    $modal         = '#edit-batch-modal';
                    return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
                }),
            Column::make('SrNo.', 'id')
                ->sortable()
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    return (($this->page - 1) * $this->getPerPage()) + ($this->counter++);
                })
                ->html(),
            Column::make('Title')
                ->sortable()
                ->searchable(),
            // Column::make('Subject_id'),
            Column::make('Subject', 'subject.title'),
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

    public function refresh(): void
    {
    }

    public function builder(): Builder
    {
        $modal = Batch::query();
        // //for serial number in proper order

        $modal->with(['subject']);
        return $modal;
    }

    public function exportSelected()
    {
        $modelData = new Batch();
        return Excel::download(new CustomExport($this->getSelected(), $modelData), 'contactus.xlsx');
    }
}
