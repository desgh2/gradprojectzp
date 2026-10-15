<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.post.index', [
            'posts' => Post::with('user')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        //валідація
        $request->validated();

        //створення запису
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'name' => $request->name,
            'heading' => $request->heading,
            'slug' => $request->slug,
            'text' => $request->text,
            'status' => Post::STATUS_ACTIVE,
            'author' => auth()->user()->id,
        ]);

        //завантаження фото
        if ($request->hasFile('poster')) {
            $file     = $request->file('poster');
            $filename = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/news/' . $post->id), $filename);

            $post->update(['poster' => $filename]);
        }

        //завантаження галереї
        if ($request->hasFile('gallery')) {
            $image_names = [];
            foreach ($request->file('gallery') as $image) {
                $filename = strtolower($image->getClientOriginalName());
                $image->move(public_path('uploads/news/' . $post->id . '/gallery'), $filename);
                $image_names[] = $filename;
            }
            $post->update(['gallery' => json_encode($image_names)]);
        }

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Новина успішно створена',
            'class'   => 'success'
        ]);
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //якщо є галерея
        if($post->gallery) {
            $gallery = [];
            //перебор масива та отримуємо шлях до зображення
            foreach (json_decode($post->gallery) as $k => $g) {
                $gallery[] = asset("uploads/news/{$post->id}/gallery/{$g}");
            }
            $post->gallery = json_encode($gallery);
        }
        return view('dashboard.post.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {

        //валідація
        $request->validated();

        //створення запису
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'name' => $request->name,
            'heading' => $request->heading,
            'slug' => $request->slug,
            'text' => $request->text,
            //'status' => Post::STATUS_ACTIVE,
            'author' => auth()->user()->id,
        ]);

        //завантаження фото
        if ($request->hasFile('poster')) {
            $file     = $request->file('poster');
            $filename = strtolower($file->getClientOriginalName());
            $file->move(public_path('uploads/news/' . $post->id), $filename);

            $post->update(['poster' => $filename]);
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
                $image->move(public_path('uploads/news/' . $post->id . '/gallery'), $filename);
                $new_gallery[] = $filename;
            }
        }
        //об`єднуємо масиви галерей
        $galleries_array = array_merge($gallery, $new_gallery);
        //оновлюємо галерею
        $post->update(['gallery' => json_encode($galleries_array)]);

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Новину успішно оновлено',
            'class'   => 'success'
        ]);
        return redirect()->route('post.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Новину успішно видалено',
            'class'   => 'success'
        ]);
        return redirect()->route('post.index');
    }

    /**
     * Update status.
     *
     * @param  object  $post
     * @return \Illuminate\Http\Response
     */
    public function status(Post $post)
    {
        $post->update([
            'status' => ($post->status == Post::STATUS_ACTIVE) ? Post::STATUS_DEACTIVE : Post::STATUS_ACTIVE,
        ]);
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Статус новини успішно оновлено',
            'class'   => 'success'
        ]);
        return back();
    }
}
