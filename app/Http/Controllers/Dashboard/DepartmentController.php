<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.department.index', [
            'departments' => Department::with('user')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.department.create', [
            'persons' => Person::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateDepartmentRequest $request)
    {
        //валідація
        $request->validated();

        //створення запису
        $department = Department::create([
            'person_id' => $request->person_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'heading' => $request->heading,
            'cabinet' => $request->cabinet,
            'phone' => $request->phone,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'text' => $request->text,
            'icon' => $request->icon,
            'status' => Department::STATUS_ACTIVE,
            'author' => auth()->user()->id,
        ]);

        //завантаження фото
        if ($request->hasFile('icon')) {
            $file     = $request->file('icon');
            $filename = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/department/icon'), $filename);

            $department->update(['icon' => $filename]);
        }

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Відділ успішно створений',
            'class'   => 'success'
        ]);
        return redirect()->route('department.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('dashboard.department.edit', [
            'department' => $department,
            'persons' => Person::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        //валідація
        $request->validated();

        //створення запису
        $department->update([
            'person_id' => $request->person_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'heading' => $request->heading,
            'cabinet' => $request->cabinet,
            'phone' => $request->phone,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'text' => $request->text,
            'author' => auth()->user()->id,
        ]);

        //завантаження фото
        if ($request->hasFile('icon')) {
            $file     = $request->file('icon');
            $filename = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/department/icon'), $filename);

            $department->update(['icon' => $filename]);
        }

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Відділ успішно оновлено',
            'class'   => 'success'
        ]);
        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Відділ успішно видалено',
            'class'   => 'success'
        ]);
        return redirect()->route('department.index');
    }

    /**
     * Update status.
     *
     * @param  object  $department
     * @return \Illuminate\Http\Response
     */
    public function status(Department $department)
    {
        $department->update([
            'status' => ($department->status == Department::STATUS_ACTIVE) ? Department::STATUS_DEACTIVE : Department::STATUS_ACTIVE,
        ]);
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Статус відділу успішно оновлено',
            'class'   => 'success'
        ]);
        return back();
    }
}
