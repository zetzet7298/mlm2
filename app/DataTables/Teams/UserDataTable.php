<?php

namespace App\DataTables\Teams;

use App\Core\AccountConstant;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->editColumn('id', function (User $model) {
                return substr($model->id, 0,5) . '..';
            })
            ->editColumn('coin', function (User $model) {
                return number_format($model->coin) . '$';
            })
            ->editColumn('first_name', function (User $model) {
                return $model ? $model->first_name . ' '. $model->last_name : '';
            })
            ->editColumn('created_at', function (User $model) {
                return date($model->created_at->format('d-m-Y H:i:s'));
            })
            ->addColumn('action', function (User $model) {
                if($model->state == AccountConstant::USER_STATE_PROCESSING){
                    return view('pages.teams.users._action-menu', compact('model'));
                }
                return '';
            })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->with(['direct_user', 'indirect_user'])->where(['type' => AccountConstant::TYPE_USER_FREE])
        ->orderBy('updated_at', 'desc')
        ->orderBy('state', 'desc')
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
                    ->setTableId('user-table')
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
            // Column::make('id'),
            Column::make('first_name'),
            Column::make('type'),
            Column::make('email'),
            Column::make('coin'),
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
