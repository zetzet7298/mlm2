<?php

namespace App\DataTables\Teams;

use App\Core\AccountConstant;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FeeUserDataTable extends DataTable
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
            ->editColumn('coin', function (User $model) {
                return number_format($model->coin) . '$';
            })
            ->editColumn('id', function (User $model) {
                return substr($model->id, 0,5) . '..';
            })
            ->editColumn('direct_user', function (User $model) {
                return $model->direct_user ? $model->direct_user->first_name . ' '. $model->direct_user->last_name : '';
            })
            ->editColumn('indirect_user', function (User $model) {
                return $model->indirect_user ? $model->indirect_user->first_name . ' '. $model->indirect_user->last_name : '';
            })
            ->editColumn('first_name', function (User $model) {
                return $model ? $model->first_name . ' '. $model->last_name : '';
            })
            ->editColumn('created_at', function (User $model) {
                return date($model->created_at->format('d-m-Y H:i:s'));
            })
            ->addColumn('action', function (User $model) {
                if($model->state == AccountConstant::USER_STATE_PAID){
                    return view('pages..teams.users._action-menu', compact('model'));
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
        if(User::isAdmin()){
            return $model->with(['direct_user', 'indirect_user'])
            ->where('type' ,'<>', AccountConstant::TYPE_USER_FREE)
            ->orderBy('created_at', 'desc')->newQuery();
        }else{
            return $model->where(['type' => 'zxczxc'])->newQuery();
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
            Column::make('id'),
            Column::make('first_name'),
            Column::make('direct_user'),
            Column::make('indirect_user'),
            Column::make('type'),
            Column::make('email'),
            Column::make('coin'),
            Column::make('created_at'),
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
