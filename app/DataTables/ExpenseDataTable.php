<?php

namespace App\DataTables;

use App\Models\Expense;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExpenseDataTable extends BaseDataTable
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
            ->addColumn('actions', fn($expense)=>$this->getActions([
                "edit"=> route("manage.expenses.edit", $expense->id),
                "delete"=>  route("manage.expenses.destroy", $expense->id)
            ]))
            ->addColumn("category",function($expense){
                return $expense->category->name;
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Expense $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Expense $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('expense-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom($this->getDom());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return $this->columnsArray([
            $this->getSNo(),
            "category",
            "amount",
            "description",
            "date"
        ]);
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Expense_' . date('YmdHis');
    }
}
