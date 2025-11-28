<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Controllers\Controller;


class CardController extends Controller
{
    public function index()
    {
        $cards = Card::all();
        return view('cards.index', compact('cards'));
    }


    public function main()
    {
        $cards = Card::all();
        return view('index', compact('cards'));
    }

    
    public function create()
    {
        return view('cards.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
    $image = $request->file('image');
    $filename = time() . '.' . $image->getClientOriginalExtension();

    $img = Image::read($image->path());
    $img->resize(800, 600, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });

    $savePath = storage_path('app/public/cards_images');
    if (!file_exists($savePath)) {
        mkdir($savePath, 0755, true);
    }

    $img->save($savePath . '/' . $filename);

    $validated['image'] = 'cards_images/' . $filename;
}


        Card::create($validated);

        return redirect()->route('cards.index')->with('success', 'Карточка успешно добавлена');
    }

    public function show(Card $card)
    {
        return view('cards.show', compact('card'));
    }

    public function edit(Card $card)
    {
        return view('cards.form', compact('card'));
    }

    public function update(Request $request, Card $card)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::read($image->path());
            $img->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save(storage_path('app/public/cards_images/' . $filename));
            $validated['image'] = 'cards_images/' . $filename;

            
            if ($card->image) {
                Storage::disk('public')->delete($card->image);
            }
        }

        $card->update($validated);

        return redirect()->route('cards.index')->with('success', 'Карточка успешно обновлена');
    }


    
    public function destroy(Card $card)
    {
        if ($card->image) {
            Storage::disk('public')->delete($card->image);
        }
        $card->delete();

        return redirect()->route('cards.index')->with('success', 'Карточка успешно удалена');
    }
}


