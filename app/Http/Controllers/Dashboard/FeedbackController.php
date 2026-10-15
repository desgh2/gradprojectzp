<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.feedback.index', [
            'rows' => Feedback::latest()->paginate(10),
            'statuses' => Feedback::$statuses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Звернення успішно видалено',
            'class'   => 'success'
        ]);
        return redirect()->route('feedback.index');
    }

    /**
     * Update status.
     *
     * @param  object  $feedback
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, Feedback $feedback)
    {
        $feedback->update([
            'status' => $request->status,
        ]);
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Статус звернення успішно оновлено',
            'class'   => 'success'
        ]);
        return back();
    }
}
