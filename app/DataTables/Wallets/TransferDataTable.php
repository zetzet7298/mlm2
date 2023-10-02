<?php

namespace App\DataTables\Wallets;

use App\Core\AccountConstant;
use App\Models\Transfer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransferDataTable extends DataTable
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
            // ->editColumn('sender_id', function (Transfer $model) {
            //     return $model->sender ? $model->sender->first_name . ' '. $model->sender->last_name : '';
            // })
            // ->editColumn('receiver_id', function (Transfer $model) {
            //     return $model->receiver ? $model->receiver->first_name . ' '. $model->receiver->last_name : '';
            // })
            ->editColumn('sender_id', function (Transfer $model) {
                return $model->sender ? $model->sender->username: '';
            })
            ->editColumn('receiver_id', function (Transfer $model) {
                return $model->receiver ? $model->receiver->username: '';
            })
            ->editColumn('created_at', function (Transfer $model) {
                return date($model->created_at->format('d-m-Y H:i:s'));
            })
            ->editColumn('state', function (Transfer $model) {
                return $model->state == AccountConstant::TRANSFER_STATE_PAID ? 'Paid' : '';
            })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transfer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transfer $model)
    {
        return $model->with(['sender', 'receiver'])
        ->where(['sender_id' => auth()->id()])
        ->orWhere(['receiver_id' => auth()->id()])
        ->orderBy('created_at', 'desc')
        ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('Transfer-table')
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
            Column::make('created_at')->title(__('Date')),
            Column::make('sender_id')->title(__('Sender')),
            Column::make('receiver_id')->title(__('Receiver')),
            Column::make('coin'),
            Column::make('content')->title((__('Transfer Content'))),
            Column::make('txid')->title((__('TxID'))),
            // Column::make('state'),
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
        return 'Transfer_' . date('YmdHis');
    }
}
