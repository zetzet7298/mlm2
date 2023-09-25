<?php

namespace App\DataTables\Wallets;

use App\Core\AccountConstant;
use App\Models\Withdrawal;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WithdrawalDataTable extends DataTable
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
            ->editColumn('created_at', function (Withdrawal $model) {
                return date($model->created_at->format('d-m-Y H:i:s'));
            })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Withdrawal $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Withdrawal $model)
    {
        return $model->with('user')->where(['user_id' => auth()->id()])->newQuery();
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
            // Column::make('id'),
            Column::make('created_at')->title(__('Date')),
            Column::make('coin'),
            Column::make('content')->title(__('Content')),
            // Column::make('user_id')->title(__('User')),
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
        return 'Withdrawal_' . date('YmdHis');
    }
}
