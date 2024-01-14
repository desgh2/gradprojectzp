<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.project.index', [
            'projects' => Project::with('user')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProjectRequest $request)
    {
        //валідація
        $request->validated();

        //створення запису
        $project = Project::create([
            'department_id' => $request->department_id,
            'title' => $request->title,
            'description' => $request->description,
            'name' => $request->name,
            'heading' => $request->heading,
            'slug' => $request->slug,
            'short_text' => $request->short_text,
            'text' => $request->text,
            'address' => $request->address,
            'type' => $request->type,
            'do_work' => $request->do_work,
            'status' => Project::STATUS_ACTIVE,
            'author' => auth()->user()->id,
        ]);

        //завантаження фото
        if ($request->hasFile('poster')) {
            $file     = $request->file('poster');
            $filename = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/projects/' . $project->id), $filename);

            $project->update(['poster' => $filename]);
        }

        //завантаження галереї
        if ($request->hasFile('gallery')) {
            $image_names = [];
            foreach ($request->file('gallery') as $image) {
                $filename = strtolower($image->getClientOriginalName());
                $image->move(public_path('uploads/projects/' . $project->id . '/gallery'), $filename);
                $image_names[] = $filename;
            }
            $project->update(['gallery' => json_encode($image_names)]);
        }

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Проєкт успішно створений',
            'class'   => 'success'
        ]);
        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //якщо є галерея
        if ($project->gallery) {
            $gallery = [];
            //перебор масива та отримуємо шлях до зображення
            foreach (json_decode($project->gallery) as $k => $g) {
                $gallery[] = asset("uploads/projects/{$project->id}/gallery/{$g}");
            }
            $project->gallery = json_encode($gallery);
        }
        return view('dashboard.project.edit', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //валідація
        $request->validated();

        //створення запису
        $project->update([
            'department_id' => $request->department_id,
            'title' => $request->title,
            'description' => $request->description,
            'name' => $request->name,
            'heading' => $request->heading,
            'slug' => $request->slug,
            'short_text' => $request->short_text,
            'text' => $request->text,
            'address' => $request->address,
            'type' => $request->type,
            'do_work' => $request->do_work,
            'author' => auth()->user()->id,
        ]);

        //завантаження фото
        if ($request->hasFile('poster')) {
            $file     = $request->file('poster');
            $filename = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/projects/' . $project->id), $filename);

            $project->update(['poster' => $filename]);
        }

        //якщо є галерея
        $gallery = [];
        //нова галерея
        $new_gallery = [];
        foreach (explode(',', $request->old_gallery) as $key => $value) {
            $gallery[] = substr(strrchr($value, '/'), 1);
        }
        //завантаження галереї
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $filename = strtolower($image->getClientOriginalName());
                $image->move(public_path('uploads/projects/' . $project->id . '/gallery'), $filename);
                $new_gallery[] = $filename;
            }
        }
        //об`єднуємо масиви галерей
        $galleries_array = array_merge($gallery, $new_gallery);
        //оновлюємо галерею
        $project->update(['gallery' => json_encode($galleries_array)]);

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Проєкт успішно оновлено',
            'class'   => 'success'
        ]);
        return redirect()->route('project.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    /**
     * Update status.
     *
     * @param  object  $project
     * @return \Illuminate\Http\Response
     */
    public function status(Project $project)
    {
        $project->update([
            'status' => ($project->status == Project::STATUS_ACTIVE) ? Project::STATUS_DEACTIVE : Project::STATUS_ACTIVE,
        ]);
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Статус проєкта успішно оновлено',
            'class'   => 'success'
        ]);
        return back();
    }
}
