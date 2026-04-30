<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Media;
use App\Models\Menu;
use App\Models\MenuPage;
use App\Models\Page;
use App\Models\PageItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\SiteCacheService;
use Illuminate\Support\Facades\Auth;
use Validator;

class AdminPageController extends Controller
{
    public function newMenu()
    {
        menuSubmenu('page', 'newMenu');
        return view('admin.pages.newMenu');
    }
    public function storeNewMenu(MenuRequest $request)
    {
        try {
            $menu = new Menu();
            $menu->menu_title = $request->menu_title;
            $menu->slug       = Str::slug($request->slug);
            $menu->menu_type  = $request->menu_type;
            $menu->addedby_id = Auth::id();
            $menu->save();

            SiteCacheService::flushSiteCaches();

            return redirect()
                ->route('admin.allMenus')
                ->with('success', 'Menu added successfully');

        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while creating the menu');
        }
    }
    public function allMenus(Request $request)
    {
        menuSubmenu('page','allMenus');
        $menus = Menu::orderby('id','desc')->get();
        return view('admin.pages.allMenus',compact('menus'));
    }
    public function deleteMenu(Request $request)
    {
        $menu = Menu::find($request->menu);
        if(!$menu){
            return redirect()->back()->with('warning','Menu Not Found');
        }
        $menu->delete();
        SiteCacheService::flushSiteCaches();
        return redirect()->back()->with('success','Menu Deleted Successfully');
    }
    public function editMenu(Menu $menu)
    {
        menuSubmenu('page','allMenus');
        return view('admin.pages.editMenu', compact('menu'));
    }

    public function updateMenu(MenuRequest $request, Menu $menu)
    {
        try {
            $menu->menu_title = $request->menu_title;
            $menu->menu_type  = $request->menu_type;
            $menu->slug       = Str::slug($request->slug); // safety
            $menu->save();

            SiteCacheService::flushSiteCaches();

            return redirect()
                ->route('admin.allMenus')
                ->with('success', 'Menu Updated Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }



    public function pagesAll(Request $request)
    {
        menuSubmenu('page','pagesAll');
        $pages = Page::orderBy('drag_id')->paginate(50);
        $menus = Menu::orderBy('menu_title')->get();
        return view('admin.pages.pagesAll',compact('pages','menus'));
    }
    public function pageAddNewPost(Request $request)
    {
       $request->validate([
        'page_title' => 'required|max:50|string',
       ]);
       $page = new Page;
        $page->page_title = $request->page_title;
        $page->title_hide = $request->title_hide ? 1 : 0;
        $page->active = $request->active ? 1 : 0;
        $page->list_in_menu = $request->list_in_menu ? 1 : 0;
        $page->addedby_id = Auth::id();
        $page->addedby_id = 1;
        $page->save();
        if(isset($request->menus))
        {
            foreach($request->menus as $menu)
            {
                $c = MenuPage::where('menu_id',$menu)
                ->where('page_id',$page->id)
                ->first();
                if(!$c)
                {
                   $c = new MenuPage;
                   $c->menu_id = $menu;
                   $c->page_id = $page->id;
                   $c->addedby_id = Auth::id();
                // $c->addedby_id = 1;
                   $c->save();
                }
            }
        }

        SiteCacheService::flushSiteCaches();

        return redirect()->back()->with('success','Page Added Successfully');
    }
    public function pageSort(Request $request)
    {
        foreach($request->sorted_data as $key => $value)
        {
            $cat = Page::where('id', $value)->first();
            $cat->drag_id = $key;
            $cat->editedby_id = Auth::id();
            $cat->save();

            SiteCacheService::flushSiteCaches();
        }
        if($request->ajax())
        {
            return Response()->json([
            'success'=>true,
            ]);
        }
        return back();
    }
    public function pageEdit(Page $page, Request $request)
    {
        $menus = Menu::orderBy('menu_title')->get();
       return view('admin.pages.pageEdit',compact('page','menus'));
    }
    public function pageItems(Request $request, Page $page)
    {
        $mediaAll = Media::latest()->paginate(200);
        return view('admin.pages.pageItems', [
            'page'=> $page,
            'mediaAll' => $mediaAll
        ]);
    }
    public function pageItemAddPost(Page $page, Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'title' => 'required|max:50|string',
            'description' => 'required|max:60000|string',
        ]);
        if($validation->fails())
        {
            return back()->withErrors($validation)
            ->withInput()
            ->with('error', 'Something went wrong.');
        }

        $item = new PageItem;
        $item->page_id = $page->id;
        $item->title = $request->title ?: null;
        $item->content = $request->description ?: null;
        $item->editor = $request->editor ? 1 : 0;
        $item->active = $request->active ? 1 : 0;
        $item->addedby_id = Auth::id();
        $item->save();

        SiteCacheService::flushSiteCaches();
 
        return back()->with('success', 'Page Item Created Successfully!');
    }
    public function pageItemDelete(Request $request, PageItem $item)
    {
        $item->delete();

        SiteCacheService::flushSiteCaches();

        return back()->with('success', 'Part of the Page Deleted Successfully');
    }
    public function pageItemEdit(Request $request, PageItem $item)
    {
        $mediaAll = Media::latest()->paginate(200);
        // return $item->page;
        return view('admin.pages.pageItemEdit', [
            'it'=> $item,
            'page' => $item->page,
            'mediaAll' => $mediaAll
        ]);
    }
    public function pageItemUpdate(Request $request, PageItem $item)
    {
        $validation = Validator::make($request->all(),
        [
            'title' => 'required|max:50|string',
            'description' => 'required|max:60000|string',
        ]);
        if($validation->fails())
        {
            return back()->withErrors($validation)
            ->withInput()
            ->with('error', 'Something went wrong.');
        }

        $item->title = $request->title ?: null;
        $item->content = $request->description ?: null;
        $item->editor = $request->editor ? 1 : 0;
        $item->active = $request->active ? 1 : 0;
        $item->editedby_id = Auth::id();
        $item->save();

        SiteCacheService::flushSiteCaches(); 

        return back()->with('success', 'Page Item Updated Successfully!');
    }
    public function pageItemEditEditor(Request $request, PageItem $item)
    {
        if($item->editor)
        {
            $item->editor = false;
        }
        else
        {
            $item->editor = true;
        }
        $item->save();

        SiteCacheService::flushSiteCaches();

        return back();
    }
    public function pageDelete(Request $request, Page $page)
    {
        $page->items()->delete();
        $page->delete();

        SiteCacheService::flushSiteCaches();

        return back()->with('success', 'Page Deleted Successfully');
    }


}
