<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEstateRequest;
use App\Http\Requests\UpdateEstateRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RealEstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = RealEstate::query();
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

        return view('dashboard.estate.index', [
            'rows' => $rows,
            'districts' => RealEstate::$districts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.estate.create', [
            'districts' => RealEstate::$districts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEstateRequest $request)
    {
        //валідація
        $request->validated();

        //створення запису
        $real_estate = RealEstate::create([
            'district_id' => $request->district_id,
            'title' =>  'Вільне приміщення за адресою ' . $request->name,
            'description' => 'Орендувати приміщення за адресою ' . $request->name,
            'name' => $request->name,
            'heading' => $request->name,
            'slug' => $request->slug,
            'text' => $request->text,
            'lat' => $request->lat,
            'lon' => $request->lon,
            'status' => RealEstate::STATUS_ACTIVE,
            'author' => auth()->user()->id,
        ]);

        //завантаження технічного паспорта
        if ($request->hasFile('pasport')) {
            $file     = $request->file('pasport');
            $pasport = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/estate/' . $real_estate->id. '/pasport'), $pasport);

            $real_estate->update(['pasport' => $pasport]);
        }

        //завантаження фото
        if ($request->hasFile('poster')) {
            $file     = $request->file('poster');
            $filename = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/estate/' . $real_estate->id), $filename);

            $real_estate->update(['poster' => $filename]);
        }

        //завантаження галереї
        if ($request->hasFile('gallery')) {
            $image_names = [];
            foreach ($request->file('gallery') as $image) {
                $filename = strtolower($image->getClientOriginalName());
                $image->move(public_path('uploads/estate/' . $real_estate->id . '/gallery'), $filename);
                $image_names[] = $filename;
            }
            $real_estate->update(['gallery' => json_encode($image_names)]);
        }

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Запис успішно створений',
            'class'   => 'success'
        ]);
        return redirect()->route('estate.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(RealEstate $real_estate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RealEstate $estate)
    {
        // dd($estate);
        //якщо є галерея
        if ($estate->gallery) {
            $gallery = [];
            //перебор масива та отримуємо шлях до зображення
            foreach (json_decode($estate->gallery) as $k => $g) {
                $gallery[] = asset("uploads/estate/{$estate->id}/gallery/{$g}");
            }
            $estate->gallery = json_encode($gallery);
        }
        return view('dashboard.estate.edit', [
            'estate' => $estate,
            'districts' => RealEstate::$districts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstateRequest $request, RealEstate $estate)
    {
        //валідація
        $request->validated();

        //створення запису
        $estate->update([
            'district_id' => $request->district_id,
            'title' =>  'Вільне приміщення за адресою ' . $request->name,
            'description' => 'Орендувати приміщення за адресою ' . $request->name,
            'name' => $request->name,
            //'heading' => $request->heading,
            'slug' => $request->slug,
            'text' => $request->text,
            'lat' => $request->lat,
            'lon' => $request->lon,
            'status' => RealEstate::STATUS_ACTIVE,
            'author' => auth()->user()->id,
        ]);

        //завантаження технічного паспорта
        if ($request->hasFile('pasport')) {
            $file     = $request->file('pasport');
            $pasport = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/estate/' . $estate->id . '/pasport'), $pasport);

            $estate->update(['pasport' => $pasport]);
        }

        //завантаження фото
        if ($request->hasFile('poster')) {
            $file     = $request->file('poster');
            $filename = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/estate/' . $estate->id), $filename);

            $estate->update(['poster' => $filename]);
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
                $image->move(public_path('uploads/estate/' . $estate->id . '/gallery'), $filename);
                $new_gallery[] = $filename;
            }
        }
        //об`єднуємо масиви галерей
        $galleries_array = array_merge($gallery, $new_gallery);
        //оновлюємо галерею
        $estate->update(['gallery' => json_encode($galleries_array)]);

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Запис успішно оновлено',
            'class'   => 'success'
        ]);
        return redirect()->route('estate.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RealEstate $estate)
    {

        File::deleteDirectory(public_path('uploads/estate/' . $estate->id));

        $estate->delete();

        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Запис успішно видалено',
            'class'   => 'success'
        ]);
        return redirect()->route('estate.index');
    }

    /**
     * Update status.
     *
     * @param  object  $real_estate
     * @return \Illuminate\Http\Response
     */
    public function status(RealEstate $real_estate)
    {
        $real_estate->update([
            'status' => ($real_estate->status == RealEstate::STATUS_ACTIVE) ? RealEstate::STATUS_DEACTIVE : RealEstate::STATUS_ACTIVE,
        ]);
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Статус запису успішно оновлено',
            'class'   => 'success'
        ]);
        return back();
    }
}
