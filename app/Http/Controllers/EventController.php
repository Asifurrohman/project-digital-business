<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request){
        $categories = Category::all();

        $events = Event::query()
            ->where('stock', '>', 0)
            ->when($request->search, function($query, $search){
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($request->category_id, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->with('category')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('events.index', compact('events', 'categories'));
    }

    public function show(Event $event){
        return view('events.show', compact('event'));
    }

    public function checkout(){
        return view('checkout');
    }

    public function transactions(){
        return view('admin.transactions');
    }

    public function categories(){
        return view('admin.categories.index');
    }
}
