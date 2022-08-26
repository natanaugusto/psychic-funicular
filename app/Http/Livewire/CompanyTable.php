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
    public const CONFIGURABLE_AREAS_VIEWS = [
        'toolbar-left-start' => ['components.create-button', null],
    ];
    protected $model = Company::class;
    public $editButtonParams = [
        'model' => Company::class,
        'inputsView' => 'companies.inputs',
        'inputRules' => [
            'model.name' => 'required|string',
            'model.doc_number' => 'required|max:20'
        ],
        'title' => 'Are you sure?',
        'confirmBtnLabel' => 'Update',
        'confirmBtnColor' => 'green',
        'confirmAction' => [
            self::class,
            'save',
            null,
            'refreshDatatable'
        ],
    ];
    public $deleteButtonParams = [
        'title' => 'Are you sure?',
        'description' => 'Do you really sure that you want to exclude this register?',
        'confirmBtnLabel' => 'Delete',
        'confirmBtnColor' => 'red' ,
        'confirmAction' => [
            self::class,
            'delete',
            null,
            'refreshDatatable'
        ],
    ];

    public function configure(): void
    {
        $areas = self::CONFIGURABLE_AREAS_VIEWS;
        $areas['toolbar-left-start'][1]['editButtonParams'] = $this->editButtonParams;
        $this->setPrimaryKey('id');
        $this->setColumnSelectDisabled();
        $this->setConfigurableAreas($areas);
        $this->setTableWrapperAttributes(attributes:self::TABLE_WRAPPER_ATTRS);
    }

    public function columns(): array
    {
        return [
            Column::make(title:'Id', from:'id')
                ->sortable(),
            Column::make(title:__(key:'Creator'), from:'creator.name')
                ->sortable()
                ->searchable()
                ->collapseOnMobile(),
            Column::make(title:__(key:'Name'), from:'name')
                ->searchable()
                ->sortable(),
            Column::make(title:__(key:'Document number'), from:'doc_number')
                ->searchable()
                ->sortable(),
            Column::make(title:__(key:'Created at'), from:'created_at')
                ->sortable()
                ->collapseOnMobile(),
            Column::make(title:__(key:'Updated at'), from:'updated_at')
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

    public function save(Company $company): bool
    {
        return $company->save();
    }

    protected function actionButtonsParams(int $id): View
    {
        $data = [
            'id' => $id,
            'editButtonParams' => $this->editButtonParams,
            'deleteButtonParams' => $this->deleteButtonParams,
        ];
        /**
         * @see \App\Http\Livewire\Modals\Modal::$confirmAction[$class, $action, $model, $event]
         */
        $data['deleteButtonParams']['confirmAction'][2] = $id;
        $data['deleteButtonParams']['title'] = __($data['deleteButtonParams']['title']);
        $data['deleteButtonParams']['description'] = __($data['deleteButtonParams']['description']);
        $data['deleteButtonParams']['confirmBtnLabel'] = __($data['deleteButtonParams']['confirmBtnLabel']);

        $data['editButtonParams']['confirmAction'][2] = $id;
        $data['editButtonParams']['title'] = __($data['editButtonParams']['title']);
        $data['editButtonParams']['confirmBtnLabel'] = __($data['editButtonParams']['confirmBtnLabel']);
        $data['editButtonParams']['model'] = Company::findOrFail($id);

        return view('components.action-buttons', $data);
    }
}
