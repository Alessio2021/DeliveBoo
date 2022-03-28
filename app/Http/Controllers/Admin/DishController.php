<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use Illuminate\Support\Facades\Auth;


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
        $dishes = Dish::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(7);
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
        }else {
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
            $newDish = New Dish();
            $newDish->fill($validated);
            $newDish->user_id = Auth::id();
            $newDish->slug = Dish::slugGenerator($validated['name'], Auth::id());
            $newDish->save();
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
                'price' => 'required|min:0.01|max:999.99',
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
        $restaurantsDish->delete();
        return redirect()->route('admin.dishes.index')->with('status', "Il piatto $restaurantsDish->name è stato cancellato");
    }
}
