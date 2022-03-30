<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use App\DishImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Dish::where('user_id', 1)->get());
        $dishes = Dish::where('user_id', Auth::user()->id)->orderBy('name', 'asc')->paginate(7);
        return view('admin.dishes.index', ['dishes' => $dishes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!empty($request['visibility'])) {
            $request['visibility'] = true;
        } else {
            $request['visibility'] = false;
        }

        $validated = $request->validate(
            [
                'name' => 'required|max:240',
                'description' => 'required',
                'price' => 'required|numeric|between:0.01,999.99',
                'image.*' => 'nullable|image',
                'visibility' => 'nullable'
            ]
        );

        $imageNumberValidated = false;


        if (empty($validated['image'])) {
            $imageNumberValidated = true;
        } else if (count($validated['image']) < 5) {
            $imageNumberValidated = true;
        }

        if ($validated && $imageNumberValidated) {
            $newDish = new Dish();
            $newDish->fill($validated);
            $newDish->user_id = Auth::id();
            $newDish->slug = Dish::slugGenerator($validated['name'], Auth::id());
            $newDish->save();

            if (!empty($validated['image'])) {
                foreach ($validated['image'] as $image) {
                    $img_path = Storage::put('uploads', $image);
                    $newDishImage = new DishImage();
                    $newDishImage->dish_id = $newDish->id;
                    $newDishImage->img_path = $img_path;
                    $newDishImage->save();
                }
            }
        }


        return redirect()->route('admin.dishes.show', $newDish);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        $restaurantsDish = Dish::where('slug', $dish->slug)->where('user_id', Auth::id())->first();
        return view('admin.dishes.show', ['dish' => $restaurantsDish]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $restaurantsDish = Dish::where('slug', $dish->slug)->where('user_id', Auth::id())->first();
        return view('admin.dishes.edit', ['dish' => $restaurantsDish]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        if (!empty($request['visibility'])) {
            $request['visibility'] = true;
        } else {
            $request['visibility'] = false;
        }
        // dd($request->all());

        $validated = $request->validate(
            [
                'name' => 'required|max:240',
                'description' => 'required',
                'price' => 'required|numeric|between:0.01,999.99',
                'image' => 'nullable|image',
                'visibility' => 'required'
            ]
        );

        if ($validated) {
            $updatedDish = Dish::where('slug', $dish->slug)->where('user_id', Auth::id())->first();
            $updatedDish->fill($validated);
            $updatedDish->slug = Dish::slugGenerator($validated['name'], Auth::id());
            $updatedDish->update();
        }


        return redirect()->route('admin.dishes.show', $updatedDish);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $restaurantsDish = Dish::where('slug', $dish->slug)->where('user_id', Auth::id())->first();

        $dishImages = DishImage::where('dish_id', $restaurantsDish->id)->get();
        if (!empty($dishImages)) {
            foreach ($dishImages as $dishImage) {
                Storage::delete($dishImage->img_path);
                $dishImage->delete();
            }
        }
        $restaurantsDish->delete();

        return redirect()->route('admin.dishes.index')->with('status', "Il piatto $restaurantsDish->name è stato cancellato");
    }
}
