<?php
namespace App\Http\Livewire;

use App\Exports\CustomExport;
use App\Models\Student;
use Excel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StudentTable extends DataTableComponent
{

    protected $model = Student::class;
    public $counter  = 1;
    public function mount()
    {
        $this->dispatchBrowserEvent('table-refreshed');
    }

    public function configure(): void
    {
        $this->counter = 1;

        $this->setFiltersDisabled();
        $this->setBulkActionsDisabled();
        $this->setColumnSelectDisabled();

        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc')
            ->setEmptyMessage('No Result Found')
            ->setTableAttributes([
                // 'id' => 'student-table',
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
            Column::make('Action')
                ->label(function ($row, Column $column) {
                    $delete_route  = route('admin.students.destroy', $row->id);
                    $edit_route    = route('admin.students.edit', $row->id);
                    $edit_callback = 'setValue';
                    $modal         = '#edit-student-modal';

                    return view('content.table-component.action', compact('edit_route', 'delete_route', 'edit_callback', 'modal'));
                }),
            Column::make('SrNo.', 'id')
                ->format(function ($value, $row, Column $column) {
                    return (($this->page - 1) * $this->getPerPage()) + ($this->counter++);
                })
                ->html(),
            Column::make("Name")
                ->collapseOnTablet()
                ->sortable()
                ->searchable()
                ->html(),
            Column::make("Phone")
                ->collapseOnTablet()
                ->searchable(),
            Column::make("Email")
                ->collapseOnTablet()
                ->searchable(),
            Column::make("Batch Name", 'batch.title')
                ->sortable(),
            Column::make("Created at", "created_at")
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

        $modal = Student::query();
        $modal->with(['batch'])->get();
        return $modal;

    }

    public function refresh(): void
    {
    }

    public function exportSelected()
    {
        $modelData = new Student;
        return Excel::download(new CustomExport($this->getSelected(), $modelData), 'contactus.xlsx');
    }
}
