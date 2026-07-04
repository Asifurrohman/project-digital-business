<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $categories = Category::all();
        
        $query = Event::with('category')->where('date', '>=', now())->orderBy('date', 'asc');
        
        if($request->has('category') && $request->category != ''){
            $query->whereHas('category', function($q) use ($request){
                $q->where('slug', $request->category);
            });
        }
                
        $events = Event::query()
            ->where('stock', '>', 0)
            ->when($request->category_id, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->with('category')
            ->latest()
            ->paginate(10)
            ->withQueryString();
        $partners = Partner::all();

        return view('welcome', compact('events', 'categories', 'partners'));
    }
}
