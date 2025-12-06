<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class VendorProductDataTable extends DataTable
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
            $editBtn = '<a href="'.route('vendor.products.edit', $query->id).'" class="btn btn-primary text-white"><i class="far fa-edit"></i></a>' ;
            $deleteBtn = '<a href="'.route('vendor.products.destroy', $query->id).'" class="btn btn-danger text-white ml-2 delete-item" style="margin-left:5px"><i class="far fa-trash-alt" ></i></a>' ;
            // $moreBtn = '<button class="btn btn-primary dropdown-toggle ml-2" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="margin-left:5px">
            //   <i class="fas fa-cog"></i>
            // </button>
                      
            // <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;">
            // <a class="dropdown-item has-icon" href=" '. route('admin.product-image-gallery.index', ['product' => $query->id]) .' "><i class="far fa-heart"></i> Image Gallery</a>
            // <a class="dropdown-item has-icon" href=" '.route('admin.products-variant.index' , ['product' => $query->id]).' "><i class="far fa-file"></i> Variants</a>
            // </div>';

            $moreBtn = '<div class="btn-group dropstart" style="margin-left:5px">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item has-icon" href=" '. route('vendor.product-image-gallery.index', ['product' => $query->id]) .' ">Image Gallery</a></li>
                  <li><a class="dropdown-item has-icon" href=" '.route('vendor.products-variant.index' , ['product' => $query->id]).' "> Variants</a></li>
                </ul>
            </div>';

              return $editBtn.$deleteBtn.$moreBtn;
            })
            ->addColumn('thumb_img', function($query){
                return "<img width='100px' src='".asset($query->thumb_img)."'></img> ";
            })
            ->addColumn('product_type', function($query){
                switch($query->product_type){
                    case 'new_arrival';
                    return "<i class='badge bg-success'>New Arrival</i>";

                    case 'best_product';
                    return "<i class='badge bg-warning'>Best Product</i>";

                    case 'top_product';
                    return "<i class='badge bg-danger'>Top Product</i>";

                    case 'featured';
                    return "<i class='badge bg-info'>Featured</i>";

                    default:
                    return "<i class='badge bg-dark'>None</i>";
                }
            })
            ->addColumn('status', function($query){
                if($query->status == 1){
                    $button = '<div class="form-check form-switch">
                                    <input class="form-check-input change-status" type="checkbox" id="flexSwitchCheckChecked" checked  data-id=" '.$query->id.' " >                                    
                            </div>';
                }else{
                    $button = '<div class="form-check form-switch">
                                    <input class="form-check-input change-status" type="checkbox" id="flexSwitchCheckChecked"  data-id=" '.$query->id.' " >                                    
                            </div>';
                }
                return $button;
                
            })
            ->addColumn('is_approved', function($query){
                if($query->is_approved == 1){
                    return "<i class='badge bg-secondary'>Approved</i>";
                }else{
                    return "<i class='badge bg-info'>Pending</i>";
                }
            })
            ->rawColumns(['action', 'thumb_img', 'product_type','status', 'is_approved'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproduct-table')
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
            Column::make('thumb_img')->width(200),
            Column::make('price'),
            Column::make('product_type'),
            Column::make('is_approved'),
            Column::make('status'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(200)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProduct_' . date('YmdHis');
    }
}
