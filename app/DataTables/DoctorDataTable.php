<?php

namespace App\DataTables;

use App\Models\Doctor;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DoctorDataTable extends BaseDataTable
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
            ->addColumn('actions', fn ($doctor) => $this->getActions([
                "edit" => route("users.doctors.edit", $doctor->id),
                "delete" =>  route("users.doctors.destroy", $doctor->id),
                "show" => route("users.doctors.show", $doctor->id)
            ]))
            ->addColumn("name", fn ($doctor) => $doctor->user->name)
            ->addColumn("email", fn ($doctor) => $doctor->user->email)
            ->addColumn("phone", fn ($doctor) => $doctor->user->phone)
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Doctor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Doctor $model)
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
            ->setTableId('doctor-table')
            ->columns($this->getColumns())
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
            "email",
            "phone",
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
        return 'Doctor_' . date('YmdHis');
    }
}
