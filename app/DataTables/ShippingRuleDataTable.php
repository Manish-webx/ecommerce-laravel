<?php

namespace App\DataTables;

use App\Models\ShippingRule;
use App\Models\GeneralSetting;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ShippingRuleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($query){
            $editBtn = "<a href=' " .route('admin.shipping-rule.edit', $query->id).  " '  class='btn btn-primary text-white'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href=' ". route('admin.shipping-rule.destroy', $query->id) . " '  class='btn btn-danger text-white ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
            return $editBtn.$deleteBtn;
        })
        
        ->addColumn('type', function($query){
            $flat = "<i class='badge badge-success'>Flat Cost</i>";
            $minimum = "<i class='badge badge-danger'>Minimum Order Amount</i>";
            if($query->type == 'flat_cost'){
                return $flat;
            }else{
                return $minimum;
            }
        })
        ->addColumn('min_cost', function($query){
            if($query->min_cost == 0){
               return GeneralSetting::first()->currency_icon.'0';
            }elseif(!empty($query->min_cost)){                
              return GeneralSetting::first()->currency_icon.$query->min_cost;
            }
        })
        ->addColumn('cost', function($query){
            if($query->cost == 0){
               return GeneralSetting::first()->currency_icon.'0';
            }elseif(!empty($query->cost)){                
                return GeneralSetting::first()->currency_icon.$query->cost;
            }           
        })
        ->addColumn('status', function($query){
            if($query->status == 1){
               $button = '<label class="custom-switch mt-2">
                    <input type="checkbox" checked name="custom-switch-checkbox" data-id=" '.$query->id.' " class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>
                </label>';
            }else{
                $button = '<label class="custom-switch mt-2">
                    <input type="checkbox" name="custom-switch-checkbox" data-id=" '.$query->id.' " class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>
                </label>';
            }
            return $button;
            
        })
        ->rawColumns(['type', 'status', 'action', 'min_cost', 'cost']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ShippingRule $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('shippingrule-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [           
            Column::make('id'),
            Column::make('name'),
            Column::make('type'),            
            Column::make('cost'),
            Column::make('min_cost'),
            Column::make('status'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(150)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ShippingRule_' . date('YmdHis');
    }
}
