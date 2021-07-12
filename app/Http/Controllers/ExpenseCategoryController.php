<?php

namespace App\Http\Controllers;

use App\DataTables\ExpenseCategoryDataTable;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function __construct()
    {
        $this->initialise(
            "/manage/expense-categories",
            "manage.expense-categories",
            [],
            [],
            ExpenseCategory::class
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpenseCategoryDataTable $expenseCategoryDataTable)
    {
        $title = "Manage Expense Categories";
        $create = route('manage.expense-categories.create');
        return $expenseCategoryDataTable->render("layout.table", compact("title", "create"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->cView("form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ExpenseCategory::create($request->all());
        return redirect($this->root_url)->with("success","Expense Category added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->isEditing = true;
        $this->expenseCategory = ExpenseCategory::find($id);
        return $this->cView("form");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ExpenseCategory::find($id)->update($request->all());
        return redirect($this->root_url)->with("success","Updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ExpenseCategory::destroy($id);
        return redirect()->back()->with("success","Expense Category removed successfully");
    }
}
