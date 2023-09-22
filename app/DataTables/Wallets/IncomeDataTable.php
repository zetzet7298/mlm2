<?php

namespace App\DataTables\Wallets;

use App\Models\Income;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class IncomeDataTable extends DataTable
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
            // ->editColumn('user_id', function (Income $model) {
            //     return $model->user ? $model->user->first_name . ' '. $model->user->last_name : '';
            // })
            ->editColumn('created_at', function (Income $model) {
                return date($model->created_at->format('d-m-Y H:i:s'));
            })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Income $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Income $model)
    {
        return $model->with('user')->where(['user_id' => auth()->id()])
        ->orderBy('created_at', 'desc')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('income-table')
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
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::make('id'),
            Column::make('coin'),
            Column::make('content'),
            // Column::make('user_id')->title(__('User')),
            Column::make('created_at'),
            // Column::make('updated_at'),
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
