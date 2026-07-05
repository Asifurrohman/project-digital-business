<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request){
        $categories = Category::all();
        
        $query = Event::with('category')
            ->where('stock', '>', 0)
            ->where('date', '>=', now())
            ->orderBy('date', 'asc');
        
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
                
        $events = $query
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
