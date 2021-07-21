<?php

namespace App\DataTables;

use App\Models\Patient;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class PatientDataTable extends BaseDataTable
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
            ->addColumn('actions', fn ($patient) => $this->getActions([
                "edit" => route("users.patients.edit", $patient->id),
                "delete" =>  route("users.patients.destroy", $patient->id),
                "show" => route("users.patients.show", $patient->id),
                "createConsultation"=>route("users.patients.consultations.create",$patient->id)
            ]))
            ->addColumn("name", fn ($patient) => $patient->user->name)
            ->addColumn("email", fn ($patient) => $patient->user->email)
            ->addColumn("phone", fn ($patient) => $patient->user->phone)
            ->addColumn("client", fn ($patient) => $patient->client->user->name)
            ->addColumn("type", fn ($patient) => $patient->patientType->name)
            ->rawColumns(['actions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Patient $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Patient $model)
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
            ->setTableId('patient-table')
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
            "client",
            "type",
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
        return 'Patient_' . date('YmdHis');
    }
}
