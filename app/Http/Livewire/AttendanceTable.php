<?php
namespace App\Http\Livewire;

use App\Exports\CustomExport;
use App\Models\Attendance;
use Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AttendanceTable extends DataTableComponent
{
    protected $model = Attendance::class;
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
        $this->setPrimaryKey('id')

            ->setDefaultSort('id', 'desc')
            ->setEmptyMessage('No Result Found')
            ->setTableAttributes([
                'id' => 'attendance-table',
            ])
            ->setBulkActions([
                'exportSelected' => 'Export',
            ]);
    }

    public function columns(): array
    {
        return [
            Column::make('SrNo.', 'id')
                ->sortable()
                ->searchable()
                ->format(function ($value, $row, Column $column) {
                    return (($this->page - 1) * $this->getPerPage()) + ($this->counter++);
                })
                ->html(),
            Column::make('Present Students', 'student.name')
                ->sortable(),
            Column::make('Batches', 'zoom.batch.title')
                ->sortable(),
            Column::make('Zoom Links', 'zoom.link'),
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

    public function builder(): Builder
    {
        $modal = Attendance::query();
        $modal->with(['zoom.batch', 'student']);
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
        $modelData = new Attendance();
        return Excel::download(new CustomExport($this->getSelected(), $modelData), 'contactus.xlsx');
    }
}
