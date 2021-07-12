<?php

namespace App\DataTables;

use App\Models\ExpenseCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExpenseCategoryDataTable extends BaseDataTable
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
            ->addColumn('actions', fn($expenseCategory)=> $this->getActions([
                "edit"=> route("manage.expense-categories.edit", $expenseCategory->id),
                "delete"=>  route("manage.expense-categories.destroy", $expenseCategory->id)
            ]))
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ExpenseCategory $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ExpenseCategory $model)
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
                    ->setTableId('expensecategory-table')
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
            "name",
            "actions"
        ]);
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ExpenseCategory_' . date('YmdHis');
    }
}
