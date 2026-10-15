<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAdvertRequest;
use App\Http\Requests\UpdateAdvertRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Advert::query();
        $query->when(request('search'), function ($q) {
            $q->where('name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('id', 'LIKE', '%' . request('search') . '%');
        });

        $query->when(request('district'), function ($d) {
            $d->where('district_id', request('district'));
        });

        $query->when(request('pasport'), function ($p) {
            $p->whereNull('pasport');
        });

        $query->when(request('poster'), function ($p) {
            $p->whereNull('poster');
        });

        $rows = $query->latest();
        $rows = $query->paginate(15);
        $links = $rows->appends(['search' => request('search'), 'district' => request('district')])->links();

        return view('dashboard.advert.index', [
            'rows' => $rows,
            'districts' => Advert::$districts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.advert.create', [
            'districts' => Advert::$districts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAdvertRequest $request)
    {
        //валідація
        $request->validated();

        //створення запису
        $advert = Advert::create([
            'district_id' => $request->district_id,
            'title' =>  $request->name,
            'description' => $request->name,
            'name' => $request->name,
            'heading' => $request->name,
            'slug' => $request->slug,
            'text' => $request->text,
            'lat' => $request->lat,
            'lon' => $request->lon,
            'status' => Advert::STATUS_ACTIVE,
            'author' => auth()->user()->id,
        ]);

        //завантажити договор
        if ($request->hasFile('pasport')) {
            $file     = $request->file('pasport');
            $filename = strtolower('adv-' . Str::random(40) . '-' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension());
            $file->storeAs('advert', $advert->id . '/pasport/' . $filename, 'public');
            $advert->update(['pasport' => $filename]);
        }

        //Завантажити дозвіл
        if ($request->hasFile('order')) {
            $file     = $request->file('order');
            $filename = strtolower('adv-' . Str::random(40) . '-' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension());
            $file->storeAs('advert', $advert->id . '/order/' . $filename, 'public');
            $advert->update(['order' => $filename]);
        }

        //Завантажити додаткові документи
        if ($request->hasFile('additional')) {
            $additional_files = [];
            foreach ($request->file('additional') as $file) {
                $filename = strtolower('adv-' . Str::random(40) . '-' . Str::slug($request->name) . '-' . $file->getClientOriginalName());
                $file->storeAs('advert', $advert->id . '/additional/' . $filename, 'public');
                $additional_files[] = $filename;
            }
            $advert->update(['additional' => json_encode($additional_files)]);
        }

        //завантаження фото
        if ($request->hasFile('poster')) {
            $file     = $request->file('poster');
            $filename = strtolower('adv-' . Str::random(40) . '-' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension());
            $file->storeAs('advert', $advert->id . '/poster/' . $filename, 'public');
            $advert->update(['poster' => $filename]);
        }

        //завантаження галереї
        if ($request->hasFile('gallery')) {
            $galleries = [];
            foreach ($request->file('gallery') as $image) {
                $filename = strtolower('adv-' . Str::random(40) . '-' . Str::slug($request->name) . '-' . $image->getClientOriginalName());
                $image->storeAs('advert', $advert->id . '/gallery/' . $filename, 'public');
                $galleries[] = $filename;
            }
            $advert->update(['gallery' => json_encode($galleries)]);
        }

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Запис успішно створений',
            'class'   => 'success'
        ]);
        return redirect()->route('advert.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advert $advert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advert $advert)
    {
        //якщо є галерея
        if ($advert->gallery) {
            $gallery = [];
            //перебор масива та отримуємо шлях до зображення
            foreach (json_decode($advert->gallery) as $k => $g) {
                $gallery[] = asset('storage/advert/' . $advert->id . '/gallery/' . $g);
            }
            $advert->gallery = json_encode($gallery);
        }
        return view('dashboard.advert.edit', [
            'advert' => $advert,
            'districts' => Advert::$districts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvertRequest $request, Advert $advert)
    {
        //валідація
        $request->validated();

        //створення запису
        $advert->update([
            'district_id' => $request->district_id,
            'title' =>  $request->name,
            'description' => $request->name,
            'name' => $request->name,
            'heading' => $request->name,
            'slug' => $request->slug,
            'text' => $request->text,
            'lat' => $request->lat,
            'lon' => $request->lon,
            'author' => auth()->user()->id,
        ]);
        
        //завантажити договор
        if ($request->hasFile('pasport')) {
            $file     = $request->file('pasport');
            $filename = strtolower('adv-' . Str::random(40) . '-' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension());
            $file->storeAs('advert', $advert->id . '/pasport/' . $filename, 'public');
            $advert->update(['pasport' => $filename]);
        }

        //Завантажити дозвіл
        if ($request->hasFile('order')) {
            $file     = $request->file('order');
            $filename = strtolower('adv-' . Str::random(40) . '-' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension());
            $file->storeAs('advert', $advert->id . '/order/' . $filename, 'public');
            $advert->update(['order' => $filename]);
        }

        //Завантажити додаткові документи
        if ($request->hasFile('additional')) {
            $additional_files = [];
            foreach ($request->file('additional') as $file) {
                $filename = strtolower('adv-' . Str::random(40) . '-' . Str::slug($request->name) . '-' . $file->getClientOriginalName());
                $file->storeAs('advert', $advert->id . '/additional/' . $filename, 'public');
                $additional_files[] = $filename;
            }
            $advert->update(['additional' => json_encode($additional_files)]);
        }

        //завантаження фото
        if ($request->hasFile('poster')) {
            $file     = $request->file('poster');
            $filename = strtolower('adv-' . Str::random(40) . '-' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension());
            $file->storeAs('advert', $advert->id . '/poster/' . $filename, 'public');
            $advert->update(['poster' => $filename]);
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
            $galleries = [];
            foreach ($request->file('gallery') as $image) {
                $filename = strtolower('adv-' . Str::random(40) . '-' . Str::slug($request->name) . '-' . $image->getClientOriginalName());
                $image->storeAs('advert', $advert->id . '/gallery/' . $filename, 'public');
                $new_gallery[] = $filename;
            }
        }
        //об`єднуємо масиви галерей
        $galleries_array = array_merge($gallery, $new_gallery);
        //оновлюємо галерею
        $advert->update(['gallery' => json_encode($galleries_array)]);

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Запис успішно оновлено',
            'class'   => 'success'
        ]);
        return redirect()->route('advert.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advert $advert)
    {
        // File::deleteDirectory(public_path('uploads/advert/' . $advert->id));

        $advert->delete();

        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Запис успішно видалено',
            'class'   => 'success'
        ]);
        return redirect()->route('advert.index');
    }

    /**
     * Update status.
     *
     * @param  object  $advert
     * @return \Illuminate\Http\Response
     */
    public function status(Advert $advert)
    {
        $advert->update([
            'status' => ($advert->status == Advert::STATUS_ACTIVE) ? Advert::STATUS_DEACTIVE : Advert::STATUS_ACTIVE,
        ]);
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Статус запису успішно оновлено',
            'class'   => 'success'
        ]);
        return back();
    }
}
