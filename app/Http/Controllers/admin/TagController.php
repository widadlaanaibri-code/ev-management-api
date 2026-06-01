<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the tags.
     */
    public function index()
    {
        $tags = Tag::withCount('events')
            ->orderBy('name', 'asc')
            ->get();

        $statistics = [
            'total' => Tag::count(),
            'withEvents' => Tag::has('events')->count(),
            'withoutEvents' => Tag::doesntHave('events')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $tags,
            'statistics' => $statistics
        ]);
    }

    /**
     * Store a newly created tag in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:tags,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $tag = Tag::create([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tag created successfully',
            'data' => $tag
        ], 201);
    }

    /**
     * Display the specified tag.
     */
    public function show(string $id)
    {
        $tag = Tag::withCount('events')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $tag
        ]);
    }

    /**
     * Update the specified tag in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:tags,name,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $tag->update([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tag updated successfully',
            'data' => $tag
        ]);
    }

    /**
     * Remove the specified tag from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);

        // Check if tag has associated events
        if ($tag->events()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete tag. It is associated with ' . $tag->events()->count() . ' event(s).'
            ], 409);
        }

        $tag->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tag deleted successfully'
        ]);
    }
}
