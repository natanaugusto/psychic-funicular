<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CompanyTable extends DataTableComponent
{
    public const PRIMARY_KEY = 'id';

    public const TABLE_WRAPPER_ATTRS = [
        'default' => false,
        'class' => 'shadow border-b border-gray-200 dark:border-gray-700 sm:rounded-lg',
    ];
    protected $model = Company::class;
    public $editButtonParams = ['inputsView' => 'companies.inputs'];
    public $deleteButtonParams = [
        'title' => 'Are you sure?',
        'description' => 'Do you really sure that you want to exclude this register?',
        'confirmAction' => [
            self::class,
            'delete',
            null,
            'refreshDatatable'
        ],
        'confirmBtnLabel' => 'Delete',
        'confirmBtnColor' => 'red' ,
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableWrapperAttributes(attributes:self::TABLE_WRAPPER_ATTRS);
        $this->setSearchDisabled();
        $this->setColumnSelectDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make(title:'Id', from:'id')
                ->sortable(),
            Column::make(title:__(key:'Creator'), from:'creator.name')
                ->sortable()
                ->collapseOnMobile(),
            Column::make(title:__(key:'Name'), from:'name')
                ->sortable(),
            Column::make(title:__(key:'Document number'), from:'doc_number')
                ->sortable(),
            Column::make(title:'Created at', from:'created_at')
                ->sortable()
                ->collapseOnMobile(),
            Column::make(title:'Updated at', from:'updated_at')
                ->sortable()
                ->collapseOnMobile(),
            Column::make(title:__(key:'Actions'), from:'id')
                ->format(callable:fn ($val) => $this->actionButtonsParams(id:$val))
                ->collapseOnMobile(),
            ];
    }

    public function delete(Company $company): bool
    {
        return $company->delete();
    }

    protected function actionButtonsParams(int $id): View
    {
        $data = [
            'id' => $id,
            'editButtonParams' => $this->editButtonParams,
            'deleteButtonParams' => $this->deleteButtonParams,
        ];
        /**
         * @see \App\Http\Livewire\Modals\Confirm::$confirmAction[$class, $action, $model, $event]
         */
        $data['deleteButtonParams']['confirmAction'][2] = $id;
        $data['deleteButtonParams']['title'] = __($data['deleteButtonParams']['title']);
        $data['deleteButtonParams']['description'] = __($data['deleteButtonParams']['description']);
        $data['deleteButtonParams']['confirmBtnLabel'] = __($data['deleteButtonParams']['confirmBtnLabel']);
        return view('components.action-buttons', $data);
    }
}
