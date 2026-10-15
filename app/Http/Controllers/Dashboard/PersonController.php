<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use Illuminate\Support\Facades\Storage;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.persons.index', [
            'persons' => Person::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.persons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePersonRequest $request)
    {
        //валідація
        $request->validated();

        //створення запису
        $person = Person::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'byfather' => $request->byfather,
            'post' => $request->post,
            'phone' => $request->phone,
            'office_number' => $request->office_number,
            'address' => $request->address,
            'status' => Person::STATUS_ACTIVE,
            'author' => auth()->user()->id,
        ]);

        //завантаження фото
        if ($request->hasFile('photo')) {
            $file     = $request->file('photo');
            $filename = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/photos'), $filename);

            $person->update(['photo' => $filename]);
        }

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Запис успішно створено',
            'class'   => 'success'
        ]);
        return redirect()->route('person.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        return view('dashboard.persons.edit', [
            'person' => $person
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, Person $person)
    {
        //валідація
        $request->validated();

        //створення запису
        $person->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'byfather' => $request->byfather,
            'post' => $request->post,
            'phone' => $request->phone,
            'office_number' => $request->office_number,
            'address' => $request->address,
            'status' => Person::STATUS_ACTIVE,
            'author' => auth()->user()->id,
        ]);

        //завантаження фото
        if ($request->hasFile('photo')) {
            $file     = $request->file('photo');
            $filename = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/photos'), $filename);

            $person->update(['photo' => $filename]);
        }

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Запис успішно оновлено',
            'class'   => 'success'
        ]);
        return redirect()->route('person.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->delete();

        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Запис успішно видалено',
            'class'   => 'success'
        ]);
        return redirect()->route('person.index');
    }

    /**
     * Update status.
     *
     * @param  object  $person
     * @return \Illuminate\Http\Response
     */
    public function status(Person $person)
    {
        $person->update([
            'status' => ($person->status == Person::STATUS_ACTIVE) ? Person::STATUS_DEACTIVE : Person::STATUS_ACTIVE,
        ]);
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Статус запису успішно оновлено',
            'class'   => 'success'
        ]);
        return back();
    }

}
