<?php

// app/Http/Controllers/MenuController.php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }
    public function userIndex(Request $request)
    {
        $category = $request->query('category');
    
        if ($category === 'promo') {
            $menus = Menu::where('category', 'promo')->get();
        } elseif ($category === 'regular') {
            $menus = Menu::where('category', 'regular')->get();
        } else {
            $menus = Menu::all(); // semua menu saat tidak memilih kategori
        }
    
        return view('menus.user', compact('menus', 'category'));
    }
    


    public function create()
    {
        $categories = Menu::select('category')->distinct()->pluck('category');
        return view('menus.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($validated);

        return redirect()->route('menus.index')->with('success', 'Menu ditambahkan!');
    }

    public function show(Menu $menu)
    {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized access.');
        }
    
        return view('menus.show', compact('menu'));
    }
    

    public function edit(Menu $menu)
    {
        $categories = Menu::select('category')->distinct()->pluck('category');
        return view('menus.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $validated['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($validated);

        return redirect()->route('menus.index')->with('success', 'Menu diperbarui!');
    }
    public function filterByCategory($category)
{
    $menus = Menu::where('category', $category)->get();
    return view('menus.user', compact('menus'));
}


    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();
        return back()->with('success', 'Menu dihapus!');
    }
}
