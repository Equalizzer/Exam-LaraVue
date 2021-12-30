<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function blockUser(Request $request)
    {
        $this->validate($request, [
            'userId' => 'exists:users,id'
        ]);

        $user = User::query()->where('id', $request->input('userId'))->firstOrFail();
        $user->is_blocked = true;

        $user->save();

        return response()->json([
            'message' => 'User successfully blocked!'
        ]);
    }

    public function unblockUser(Request $request)
    {
        $this->validate($request, [
            'userId' => 'exists:users,id'
        ]);

        $user = User::query()->where('id', $request->input('userId'))->firstOrFail();
        $user->is_blocked = false;

        $user->save();

        return response()->json([
            'message' => 'User successfully unblocked!'
        ]);
    }

    public function deleteUser($userId)
    {
        $deleted = User::query()->where('id', $userId)->delete();

        if (!$deleted) {
            return response()->json([
                'error' => 'Something went wrong'
            ]);
        }

        return response()->json([
            'message' => 'User successfully deleted'
        ]);
    }
}
