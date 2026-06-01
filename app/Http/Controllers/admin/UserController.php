<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpectatorResource;
use App\Http\Resources\OrganizerResource;
use App\Mail\RequestAccepted;
use App\Mail\RequestRejected;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Get all spectators
     */
    public function getSpectators()
    {
        $spectators = User::whereHas('roles', function ($query) {
            $query->where('name', 'spectator');
        })->get();

        $stats = [
            'total' => $spectators->count(),
            'active' => $spectators->where('status', 'accepted')->count(),
            'inactive' => $spectators->where('status', '!=', 'accepted')->count(),
            'newThisMonth' => User::whereHas('roles', function ($query) {
                $query->where('name', 'spectator');
            })->whereMonth('created_at', now()->month)->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => SpectatorResource::collection($spectators),
            'stats' => $stats,
        ]);
    }

    /**
     * Get all organizers
     */
    public function getOrganizers()
    {
        $organizers = User::whereHas('roles', function ($query) {
            $query->where('name', 'organizer');
        })->get();

        $stats = [
            'total' => $organizers->count(),
            'pending' => $organizers->where('status', 'pending')->count(),
            'accepted' => $organizers->where('status', 'accepted')->count(),
            'rejected' => $organizers->where('status', 'banned')->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => OrganizerResource::collection($organizers),
            'stats' => $stats,
        ]);
    }

    /**
     * Update organizer status (accept/reject)
     */
    public function updateOrganizerStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,banned',
        ]);

        $user = User::findOrFail($id);

        // Check if user is an organizer
        if (!$user->roles()->where('name', 'organizer')->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'User is not an organizer',
            ], 400);
        }

        $user->status = $request->status;

        // Send email notification based on status
        if ($request->status === 'accepted') {
            try {
                Mail::to($user->email)->send(new RequestAccepted($user));
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::error('Failed to send acceptance email: ' . $e->getMessage());
            }
        } elseif ($request->status === 'banned') {
            try {
                Mail::to($user->email)->send(new RequestRejected($user));
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::error('Failed to send rejection email: ' . $e->getMessage());
            }
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Organizer status updated successfully',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'status' => $user->status,
            ],
        ]);
    }

    /**
     * Update spectator status
     */
    public function updateSpectatorStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,banned',
        ]);

        $user = User::findOrFail($id);

        // Check if user is a spectator
        if (!$user->roles()->where('name', 'spectator')->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'User is not a spectator',
            ], 400);
        }

        $user->status = $request->status;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Spectator status updated successfully',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'status' => $user->status,
            ],
        ]);
    }

    /**
     * Delete a user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ]);
    }
}
