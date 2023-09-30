<?php

namespace App\DataTables;

use App\Core\AccountConstant;
use App\Models\User;
use App\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('image', function (Product $model) {
                return view('pages.products._image', compact('model'));
            })
            ->editColumn('price', function (Product $model) {
                return number_format($model->price) . '$';
            })
            ->editColumn('created_at', function (Product $model) {
                return date($model->created_at->format('d-m-Y H:i:s'));
            })
            ->addColumn('action', function (Product $model) {
                // if($model->state == AccountConstant::USER_STATE_PROCESSING){
                    return view('pages.products._action-menu', compact('model'));
                // }
                return '';
            })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        if(!User::isAdmin()){
            return $model
            // ->with(['direct_user', 'indirect_user'])->where(['type' => AccountConstant::TYPE_USER_FREE])
            ->where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->active()
            // ->orderBy('state', 'desc')
            ->newQuery();
        }else{
            return $model
            ->active()
            ->orderBy('created_at', 'desc')
            ->newQuery();
        }

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('image'),
            Column::make('details'),
            Column::make('price'),
            Column::make('quantity'),
            Column::make('created_at'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(170)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Income_' . date('YmdHis');
    }
}
