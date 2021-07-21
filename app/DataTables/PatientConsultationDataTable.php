<?php

namespace App\DataTables;

use App\Models\Consultation;
use App\Models\Patient;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PatientConsultationDataTable extends BaseDataTable
{
    private $patient;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }
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
            ->addColumn('actions', fn ($consultation) => $this->getActions([
                "show" => route('users.patients.consultations.show', [
                    "consultation" => $consultation->id,
                    "patient" => $consultation->patient_id
                ]),
                "edit" => route("users.patients.consultations.edit", [
                    "consultation" => $consultation->id,
                    "patient" => $consultation->patient_id
                ]),
                "delete" =>  route("users.patients.consultations.destroy", [
                    "consultation" => $consultation->id,
                    "patient" => $consultation->patient_id
                ])
            ]))
            ->addColumn("doctor", fn ($consultation) => $consultation->doctor->name ?? "Doctor not assigned")
            ->editColumn("date", fn ($consultation) => $consultation->date->format("d/m/Y"))
            ->editColumn("status", fn ($consultation) => $consultation->formatted_status)
            ->editColumn("charge", fn ($consultation) => number_format($consultation->charge))
            ->rawColumns(['actions', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PatientConsultation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Consultation $model)
    {
        return $this->patient->consultations()->orderBy("date", "desc");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('patientconsultation-table')
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
            "date",
            "doctor",
            "description",
            "status",
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
        return 'PatientConsultation_' . date('YmdHis');
    }
}
