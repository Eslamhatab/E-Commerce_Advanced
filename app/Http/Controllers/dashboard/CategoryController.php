<?php

namespace App\Http\Controllers\dashboard;

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
        return view('dashboard.pages.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validate Category
         $request->validate([
            'title'        => 'required|string|unique:categories,title|max:255',
            'description'  => 'nullable|string|max:1020',
        ]);
            //create Category
            $category               = new Category();
            $category->title        = $request->title;
            $category->description  = $request->description;
            $category->updated_at   = null;
            $category->save();

            return redirect()->route('categories.index')->with('created_category_successfully', "The category ($category->title) has been created successfully.");
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
            return view('dashboard.pages.categories.categories-404');
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
                return view('dashboard.pages.categories.categories-404');
            }
            return view('dashboard.pages.categories.edit', compact('category'));
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
            'title'        => 'required|max:255',
            'description'  => 'nullable|max:1020',
        ]);
            //update Category
            $category_old    = Category::find($id);
            $category        = Category::find($id);
            $category->title = $request->title;
            if($category->title == $request->title){
                $category->title = $category->title; //same value in the DB
            }
            else{
                $category->title = $request->title; //new updated value in DB
            }

            $category->description  = $request->description;
            $category->save();

            return redirect()->route('categories.index')->with('updated_category_successfully', "The category ($category_old->title) has been updated successfully.");
        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
        //function Clear
        public function clearProducts($id){
            $category = Category::find($id);
            if($category == null){
                return view('dashboard.pages.categories.categories-404');
            }
            $category->product()->delete();
            return redirect()->route('categories.show', $category->id)->with('deleted_categoryProducts_successfully', "The products for category ($category->title) has been deleted successfully.");

        }


    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('softDeleted_category_successfully', "The category ($category->title) has been moved to trash successfully.");
    }

    public function restore($id){
        $category = Category::find($id);
        $category->restore();
        return redirect()->route('categories.index')->with('restored_category_successfully', "The category ($category->title) has been restored successfully.");
    }

    public function forceDelete($id){
        $category = Category::where('id', $id);
        $category->forceDelete();
        return redirect()->route('categories.index')->with('forceDeleted_category_successfully', "The category ($category->title) has been permanently deleted successfully.");
    }
}

