<?php

namespace App\Http\Controllers\FcuApi;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate();

        return view('fcuapi.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fcuapi.student.create-or-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'stu_id'   => [
                'required',
                'unique:students,stu_id',
                'regex:/[A-Z]\\d+/',
            ],
            'stu_name' => 'required',
            'in_year'  => 'required|numeric',
        ]);

        Student::create($request->all());

        return redirect()->route('fcuapi.student.index')->with('global', '學生已新增');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('fcuapi.student.create-or-edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'stu_id'   => [
                'required',
                'unique:students,stu_id,' . $student->stu_id . ',stu_id',
                'regex:/[A-Z]\\d+/',
            ],
            'stu_name' => 'required',
            'in_year'  => 'required|numeric',
        ]);

        $student->update($request->all());

        return redirect()->route('fcuapi.student.index')->with('global', '學生已更新');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
