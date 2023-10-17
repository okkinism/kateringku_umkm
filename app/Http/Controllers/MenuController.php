<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index_menu()
    {
        $user = Auth::user();
        $menus = Menu::all();
        $dishes = Dish::all();

        return view('index_menu', compact('menus', 'dishes', 'user'));
    }

    public function create_menu()
    {
        return view('create_menu');
    }

    public function store_menu(Request $request)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required'
        ]);

        $file = $request->file('gambar');
        $path = time() . '_' . $request->nama_makanan . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Menu::create([
            'nama_makanan' => $request->nama_makanan,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path
        ]);

        return Redirect::route('index_menu');
    }

    public function show_detail(Menu $menu)
    {
        $dishes = Dish::where('menu_id', $menu->id)->get();
        $dish = $dishes->first();
    
        return view('show_detail', compact('menu', 'dish', 'dishes'));
    }    

    public function edit_menu(Menu $menu)
    {
        return view('edit_menu', compact('menu'));
    }

    public function update_menu(Menu $menu, Request $request)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required'
        ]);

        $file = $request->file('gambar');
        $path = time() . '_' . $request->nama_makanan . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $menu->update([
            'nama_makanan' => $request->nama_makanan,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path
        ]);

        return Redirect::route('show_detail', $menu);
    }

    public function delete_menu(Menu $menu)
    {
        $menu->delete();
        return Redirect::route('index_menu');
    }

    public function add_dishes(Dish $dish)
    {
        return view('add_dishes', compact('dish'));
    }

    public function store_dish(Menu $menu, Dish $dish, Request $request)
    {
        $menu_id = $menu->id;
        $request->validate([
            'nama_lauk' => 'required',
            'harga' => 'required',
        ]);

        Dish::create([
            'menu_id' => $menu_id,
            'nama_lauk' => $request->nama_lauk,
            'harga' => $request->harga
        ]);

        $dishes = Dish::where('menu_id', $menu_id)->get();

        return view('show_detail', compact('dishes', 'menu'));
    }

    public function delete_dish(Dish $dish)
    {
        $dish->delete();
        
        return Redirect::route('index_menu');
    }
}
