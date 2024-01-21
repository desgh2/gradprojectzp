<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.category.index', [
            'categories' => Category::with('user', 'category')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.create', [
            'parents' => Category::getParentCategories()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        //валідація
        $request->validated();

        //створення запису
        $category = Category::create([
            'parent' => $request->parent ?? NULL,
            'title' => $request->title,
            'description' => $request->description,
            'name' => $request->name,
            'heading' => $request->heading,
            'slug' => $request->slug,
            'text' => $request->text,
            'status' => Category::STATUS_ACTIVE,
            'author' => auth()->user()->id,
            'primary_menu' => $request->has('primary_menu'),
            'footer_menu' => $request->has('footer_menu'),
        ]);

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Категорія успішно створено',
            'class'   => 'success'
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', [
            'category' => $category,
            'parents' => Category::getParentCategories()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //валідація
        $request->validated();

        //оновлення запису
        $category->update([
            'parent' => $request->parent ?? NULL,
            'title' => $request->title,
            'description' => $request->description,
            'name' => $request->name,
            'heading' => $request->heading,
            'slug' => $request->slug,
            'text' => $request->text,
            //'status' => Category::STATUS_ACTIVE,
            'author' => auth()->user()->id,
            'primary_menu' => $request->has('primary_menu'),
            'footer_menu' => $request->has('footer_menu'),
        ]);

        //повідомлення
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Категорію успішно оновлено',
            'class'   => 'success'
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Категорію успішно видалено',
            'class'   => 'success'
        ]);
        return redirect()->route('category.index');
    }


    /**
     * Update status.
     *
     * @param  object  $category
     * @return \Illuminate\Http\Response
     */
    public function status(Category $category)
    {
        $category->update([
            'status' => ($category->status == Category::STATUS_ACTIVE) ? Category::STATUS_DEACTIVE : Category::STATUS_ACTIVE,
        ]);
        session()->flash('alert', [
            'title'   => 'ОК!',
            'message' => 'Статус категорії успішно оновлено',
            'class'   => 'success'
        ]);
        return back();
    }

}
