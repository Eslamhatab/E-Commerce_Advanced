<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::orderBy('id' , 'desc')->simplePaginate(4);
        return view('dashboard.pages.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $category = Category::find($id);
        if($category == null){
            return view('dashboard.pages.categories.categories-404' , compact('category'));
        }
            return view('dashbord.categories.index' , compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
            $category = Category::find($id);
            if($category == null){
                return view('dashbord.pages.categories.categories-404');
            }
            return view('dashboard.pages.categories.edit');
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id){
        // Validate Category
        $request->validate([
            'title'        => 'required|unique::categories|max:255',
            'description'  => 'nulable|max:1020',
        ]);
            //update Category
            $category_old = Category::find($id);
            $category     = Category::find($id);

            $category->title        = $request->title;
            $category->description  = $request->description;
            $category->save();

            if($category_old->title != $category->title &&
            $category_old->description == $category->description){
                $message_title = "Succsessful_category_title_Updated";
                $message_body  = "The Category ($category->id. $category_old->title) Was Succsessully Updated Form \"$category_old->title\" to \"$category->title\".";
                return Redirect('categories')->with($message_title , $message_body);
            }
            elseif($category_old->description != $category->description &&
            $category_old->title == $category->title){
                $message_title = "Succsessful_category_description_updated";
                $message_body  = "the Category ($category->id. $category->title)description was updated succsessfully";

                return redirect('/categories')->with($message_title , $message_body);
            }
            elseif($category_old->description != $category->description &&
            $category_old->title != $category->title ){
                $message_title = "successful_category_all_attributes_updated";
                $message_body  = "The Category ($category->id. $category_old->title) all attributes was updated successfully.";
                return redirect('/categories')->with($message_title ,$message_body);
        }
        else{
            $message_title = "category_same_all_attributes";
            $message_body  = "The Category ($category->id. $category->title) all attributes' values remains the same values.";
            return redirect('/categories')->with($message_title, $message_body);
        }
        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
        public function destroy($id){
        //
    }
}

