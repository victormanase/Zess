<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;

class BaseDataTable extends DataTable
{

    protected function getDom()
    {
        return "<'row'<'col-sm-12 col-md-4'f><'col-sm-12 col-md-4 text-center'B><'col-sm-12 col-md-4 text-right'l>>" .
            "<'row'<'col-sm-12'tr>>" .
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>";
    }

    protected function getSNo()
    {
        return ['title' => 'S/No.', 'orderable' => false, 'searchable' => false, 'render' => function () {
            return 'function(data,type,fullData,meta){return meta.settings._iDisplayStart+meta.row+1;}';
        }];
    }

    protected function columnsArray($array)
    {
        $columns = [];
        foreach ($array as $key => $value) {
            if (is_string($value))
                $columns[] = Column::make($value);
            else
                $columns[] = $value;
        }
        return $columns;
    }

    public function getLengthMenu()
    {
        return [10, 25, 50, 100, 1000, 5000];
    }

    public function getActions(array $options)
    {
        return view("components.table-actions", $options)->render();
    }
}
