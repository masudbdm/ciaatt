<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\SiteCacheService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class TeamController extends Controller
{
    // 🔹 List
    public function index()
    {
        menuSubmenu('team','allTeams');

        $teams = Team::orderBy('drag_id')->orderBy('id')->get();
        return view('admin.teams.index', compact('teams'));
    }

    // 🔹 Create Form
    public function create()
    {
        menuSubmenu('team','addTeam');
        return view('admin.teams.create');
    }

    // 🔹 Store
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:teams,username',
            'designation'   => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'location'      => 'nullable|string|max:255',
            'age'           => 'nullable|integer',
            'gender'        => 'required|in:male,female,other',
            'bio'           => 'nullable|string',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'social_links'  => 'nullable|array',
            'status'        => 'nullable|boolean',
            'featured'      => 'nullable|boolean',
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                function ($attr, $value, $fail) {
                    [$w, $h] = getimagesize($value);
                    if ($w !== $h) {
                        $fail('Image must be square (1:1)');
                    }
                }
            ],

        ]);

        
        $data = $request->only([
            'name','designation','email','phone',
            'qualification','location','age','gender',
            'bio','social_links'
        ]);

        $data['username'] = Str::slug($request->username);

        // Image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('teams', 'public');
        }

        $data['status']      = $request->status ?? 0;
        $data['featured']    = $request->featured ?? 0;
        $data['addedby_id']  = Auth::id();

        Team::create($data);
        SiteCacheService::flushSiteCaches();


        return redirect()->route('teams.index')
            ->with('success', 'Team member created successfully');
    }

    // 🔹 Edit Form
    public function edit($id)
    {
        menuSubmenu('team','allTeams');
        $team = Team::findOrFail($id);
        return view('admin.teams.edit', compact('team'));
    }

    // 🔹 Update
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'username'      => 'required|string|max:255|unique:teams,username,' . $team->id,
            'designation'   => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'location'      => 'nullable|string|max:255',
            'age'           => 'nullable|integer',
            'gender'        => 'required|in:male,female,other',
            'bio'           => 'nullable|string',
            'image'         => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
                function ($attr, $value, $fail) {
                    [$w, $h] = getimagesize($value);
                    if ($w !== $h) {
                        $fail('Image must be square (1:1)');
                    }
                }
            ],
            'social_links'  => 'nullable|array',
            'status'        => 'nullable|boolean',
            'featured'      => 'nullable|boolean',
        ]);

        $data = $request->only([
            'name','designation','email','phone',
            'qualification','location','age','gender',
            'bio','social_links'
        ]);

        $data['username'] = Str::slug($request->username);



        // Image update
        if ($request->hasFile('image')) {

            if ($team->image && \Storage::disk('public')->exists($team->image)) {
                \Storage::disk('public')->delete($team->image);
            }

            $data['image'] = $request->file('image')->store('teams', 'public');
        }

        $data['status']   = $request->status ?? 0;
        $data['featured'] = $request->featured ?? 0;

            // 🔹 IMPORTANT: Edited By
        $data['editedby_id'] = Auth::id();

        $team->update($data);
        SiteCacheService::flushSiteCaches();


        return redirect()
            ->route('teams.index')
            ->with('success', 'Team member updated successfully');
    }


    // 🔹 Delete
    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        if ($team->image && Storage::disk('public')->exists($team->image)) {
            Storage::disk('public')->delete($team->image);
        }

        $team->delete();
        SiteCacheService::flushSiteCaches();


        return redirect()->route('teams.index')
            ->with('success', 'Team member deleted successfully');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array'
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->order as $index => $id) {
                Team::where('id', $id)->update([
                    'drag_id' => $index + 1
                ]);
            }
        });

        SiteCacheService::flushSiteCaches();


        return response()->json([
            'status' => true,
            'message' => 'Team order updated'
        ]);
    }
}
