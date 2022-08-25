<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CompanyTable extends DataTableComponent
{
    public const PRIMARY_KEY = 'id';

    public const TABLE_WRAPPER_ATTRS = [
        'default' => false,
        'class' => 'shadow border-b border-gray-200 dark:border-gray-700 sm:rounded-lg',
    ];
    // public const CONFIGURABLE_AREAS_VIEWS = [
    //     'toolbar-left-start' => 'tasks.create-button',
    // ];
    protected $model = Company::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setTableWrapperAttributes(attributes:self::TABLE_WRAPPER_ATTRS);
        // $this->setConfigurableAreas(areas:self::CONFIGURABLE_AREAS_VIEWS);
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
                ->format(callable:static fn ($val) => view('components.action-buttons', [
                    'id' => $val,
                    'confirmAction' => [
                        self::class,
                        'delete',
                        $val,
                        'refreshDatatable'
                    ],
                    'confirmBtnLabel' => 'Delete',
                    'confirmBtnColor' => 'red',
                ]))
                ->collapseOnMobile(),
        ];
    }

    public function delete(Company $company): bool
    {
        return $company->delete();
    }
}
