<?php

namespace App\Http\Controllers\Admin\categorySubcategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\WebsiteParameter;
// use Auth;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
// use Validator;

class CatSubcategoryController extends Controller
{

    //Category With Tree
    public function allCategory()
    {
        // dd("ok");
        menuSubmenu('category', 'allCategory');
        $cats = Category::orderBy('drag_id')->get();
        return view('admin.categories.allCategories', compact('cats'));
    }

    public function categoryAddNewPost(Request $request)
    {
        // dd($request->all());
        foreach (editions() as $key => $lan) {
            $validation = Validator::make(
                $request->all(),
                [
                    $lan . '_category' => 'required|min:2|max:100|unique:categories,name'
                ]
            );
        }

        if ($validation->fails()) {
            return back()
                ->withErrors($validation)
                ->withInput()
                ->with('error', 'Something Went Wrong!');
        }

        $web_editons = explode(',', WebsiteParameter::first()->news_editions);

        $categories = [];
        foreach ($web_editons as $key => $lan) {
            $cat = $lan . "_category";
            $catt = $request[$cat];
            $categories[$lan] = $catt;
        }

        // return $category;
        $cat = new Category;
        $cat->name = $categories;
        $cat->description_en = $request->description_en;
        $cat->addedby_id = $request->user()->id;
        $cat->save();
        $cat->drag_id = $cat->id;
        $cat->save();
        
        // $me = Auth::user();
        // if ($cp = $request->cover_image) 
        // {
        //     $f = 'categories/' . $cat->drag_id->cover_image;
        //     // dd($f);
        //     if (Storage::disk('public')->exists($f)) 
        //     {
        //         Storage::disk('public')->delete($f);
        //     }
        //     // dd($request->image_name);
        //     $extension = strtolower($cp->getClientOriginalExtension());
        //     $randomFileName = $cat->drag_id . 'img' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;
        //     // Storage::disk('public')->put('users/' . $randomFileName, File::get($cp));
        //     $request->cover_image->move(public_path('storage/categories/'), $randomFileName);

        //     $cat->cover_image = $randomFileName;
        //     $cat->save();
        // } 

        Cache::flush();

        return back()->withInput()->with('success', 'New Category Successfully Created.');
    }
    
    public function catSort(Request $request)
    {
        foreach ($request->sorted_data as $key => $value) {
            $cat = Category::where('id', $value)->first();
            $cat->drag_id = $key;
            $cat->editedby_id = Auth::id();
            $cat->save();
        }

        Cache::flush();
        if ($request->ajax()) {
            return Response()->json([
                'success' => true,
            ]);
        }

        return back();
    }
    public function categoryDelete(Category $cat, Request $request)
    {
        // $cat->posts()->detach();

        // foreach ($cat->subcats as $subcat) 
        // {
        //     $subcat->posts()->detach();    
        // }
        $cat->subcats()->delete();
        $cat->delete();

        Cache::flush();

        if ($request->ajax()) {
            return Response()->json('success');
        }



        return back();
    }
    public function categoryEdit(Category $cat, Request $request)
    {

        if ($request->ajax()) {
            return Response()->json(View('admin.categories.ajax.catTbodyEdit', [
                'cat' => $cat,
            ])->render());
        }
    }
    public function categoryUpdate(Category $cat, Request $request)
    {
        app()->setLocale($request->lan);

        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|max:100|unique:categories,name',
            ]
        );
        if ($validation->fails()) {
            return Response()->json(View('admin.categories.ajax.catTable', [
                'cat' => $cat,
            ])->render());
        }


        // $name = $request->name;
        $cat_old_name = $cat->name;
        $cat->name = $request->name ?? $cat_old_name;
        $cat->description_en = $request->description_en ?? "";
        $cat->editedby_id = Auth::id();
        $cat->save();

        Cache::flush();

        if ($request->ajax()) {
            return Response()->json(View('admin.categories.ajax.catTable', [
                'cat' => $cat,
            ])->render());
        }



        return back();
    }
    public function subcatAddNew(Category $cat, Request $request)
    {

        // $validation = Validator::make(
        //     $request->all(),
        //     [
        //         'name' => 'required|min:2|max:100|unique:sub_categories,name',
        //     ]
        // );
        // if ($validation->fails()) {
        //     return Response()->json(View('admin.categories.ajax.catTable', [
        //         'cat' => $cat,
        //     ])->render());
        // }
        $subcategories = [];
        foreach (editions() as $key => $lan) {
            $subCatField = $lan . "_subcat";
            $sc = $request[$subCatField];
            $subcategories[$lan] = $sc;
        }

        $subcat = new SubCategory;
        $subcat->category_id = $cat->id;
        $subcat->name = $subcategories ?: null;
        $subcat->addedby_id = Auth::id();
        $subcat->editedby_id = Auth::id();
        $subcat->save();

        Cache::flush();

        if ($request->ajax()) {
            return Response()->json(View('admin.categories.ajax.subcatTable', [
                'cat' => $cat,
            ])->render());
        }



        return back();
    }
    public function subcatDelete(Subcategory $subcat, Request $request)
    {
        // $subcat->posts()->detach();
        $subcat->delete();

        Cache::flush();

        if ($request->ajax()) {
            return Response()->json(['success' => true]);
        }



        return back();
    }
    public function subcatEdit(SubCategory $subcat, Request $request)
    {
        // $subCat= SubCategory::where('id',$request->subcat)->first();
        // return $subcat->name;
        $html= View('admin.categories.ajax.subcatTbodyEdit',['subcat'=>$subcat])->render();
// return $html;
        if ($request->ajax()) {
            return Response()->json([
                'html'=>$html
            ]);
        }
    }
    public function subcatUpdate(SubCategory $subcat ,Request $request)
    {
        app()->setLocale($request->lan);

        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2|max:100|unique:sub_categories,name',
            ]
        );
        if ($validation->fails()) {
            return Response()->json(view('admin.categories.ajax.updateSubcat',['subcat'=>$subcat])->render());
        }


        // $name = $request->name;
        $cat_old_name = $subcat->name;
        $subcat->name = $request->name ?? $cat_old_name;
        $subcat->editedby_id = Auth::id();
        $subcat->save();

        Cache::flush();

        if ($request->ajax()) {
            return Response()->json(view('admin.categories.ajax.updateSubcat',['subcat'=>$subcat])->render());
        }



        return back();
      
    }
}
