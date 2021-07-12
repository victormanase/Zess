<?php

namespace App\DataTables;

use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\DoctorConsultation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DoctorConsultationDataTable extends BaseDataTable
{
    private $doctor;

    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
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
                "edit" => route("users.users.doctors.consultations.edit", [
                    "consultation" => $consultation->id,
                    "doctor" => $consultation->doctor_id
                ]),
                "delete" =>  route("users.users.doctors.consultations.destroy", [
                    "consultation" => $consultation->id,
                    "doctor" => $consultation->doctor_id
                ])
            ]))
            ->addColumn("patient", fn ($consultation) => $consultation->patient->name ?? "Something went wrong")
            ->editColumn("date", fn ($consultation) => $consultation->date->format("d/m/Y"))
            ->editColumn("status", fn ($consultation) => $consultation->formatted_status)
            ->editColumn("charge", fn ($consultation) => number_format($consultation->charge))
            ->rawColumns(['actions', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DoctorConsultation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Consultation $model)
    {
        return $this->doctor->consultations()->orderBy("date", "desc");
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('doctorconsultation-table')
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
            "patient",
            "description",
            "charge",
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
        return 'DoctorConsultation_' . date('YmdHis');
    }
}
