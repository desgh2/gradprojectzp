<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        if (Setting::first()) {
            return $this->edit($setting);
        }
        return $this->create();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        //валідація
        $request->validated();

        //створення запису
        $setting = Setting::create([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'work_time' => $request->work_time,
            'address' => $request->address,
            'text' => $request->text,
        ]);

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Налаштування сайта успішно створені',
            'class'   => 'success'
        ]);
        return redirect()->route('setting.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('dashboard.setting.edit', [
            'setting' => $setting
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        //валідація
        $request->validated();

        //створення запису
        $setting->update([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'work_time' => $request->work_time,
            'address' => $request->address,
            'text' => $request->text,
        ]);

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Налаштування сайта успішно оновлені',
            'class'   => 'success'
        ]);
        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
