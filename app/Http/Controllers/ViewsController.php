<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Category;
use Orchid\Attachment\Models\Attachment;

class ViewsController extends Controller
{
    public function index()
    {
        $categories = Category::all()->map(function ($category) {
            $image = Attachment::find($category->image);
            $category->image = $image ? $image->url() : null;
            return $category;
        });
    
        return view("index", [
            'categories' => $categories,
        ]);
    }

    public function register()
    {
        return view("pages.register");
    }

    public function login()
    {
        return view("pages.login");
    }

    public function profile()
    {
        return view("pages.profile");
    }

    public function basket()
    {
        return view("pages.basket", [
            'products' => Basket::all(),
        ]);
    }

    public function category(Category $category)
    {
        return view("pages.category", [
            'category' => $category,
        ]);
    }
}
