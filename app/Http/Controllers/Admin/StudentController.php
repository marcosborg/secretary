<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Assignment;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Student::with(['assignments'])->select(sprintf('%s.*', (new Student())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'student_show';
                $editGate = 'student_edit';
                $deleteGate = 'student_delete';
                $crudRoutePart = 'students';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? Student::GENDER_RADIO[$row->gender] : '';
            });
            $table->editColumn('responsibility', function ($row) {
                return $row->responsibility ? Student::RESPONSIBILITY_RADIO[$row->responsibility] : '';
            });
            $table->editColumn('assignments', function ($row) {
                $labels = [];
                foreach ($row->assignments as $assignment) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $assignment->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'assignments']);

            return $table->make(true);
        }

        return view('admin.students.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignments = Assignment::pluck('name', 'id');

        return view('admin.students.create', compact('assignments'));
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->all());
        $student->assignments()->sync($request->input('assignments', []));

        return redirect()->route('admin.students.index');
    }

    public function edit(Student $student)
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assignments = Assignment::pluck('name', 'id');

        $student->load('assignments');

        return view('admin.students.edit', compact('assignments', 'student'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());
        $student->assignments()->sync($request->input('assignments', []));

        return redirect()->route('admin.students.index');
    }

    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->load('assignments');

        return view('admin.students.show', compact('student'));
    }

    public function destroy(Student $student)
    {
        abort_if(Gate::denies('student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentRequest $request)
    {
        Student::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
