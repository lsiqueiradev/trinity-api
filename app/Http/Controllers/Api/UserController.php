<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {
        $users = User::query();

        $pageIndex = $request->has('page') ? $request->input('page') : 1;

        $perPage = 10;

        if($request->has('name')){
            $users->where('name', 'like', "%{$request->input('name')}%");
        }

        if($request->has('email')){
            $users->where('email', 'like', "%{$request->input('email')}%");
        }

        if($request->has('status')){
            $users->where('status', 'like', "%{$request->input('status')}%");
        }

        $total = $users->get()->count();
        $users = $users->offset(($pageIndex - 1) * 10)->limit($perPage)->get();

        return response()->json([
            'users' => $users,
            'meta' => [
                'pageIndex' => (float)$pageIndex,
                'totalCount' => $total,
                'perPage' => $perPage
            ],
        ], 200);
    }

    public function edit(String $id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuário não encontrado.',
            ], 401);
        }

        return response()->json([
            'user' => $user
        ], 200);
    }

    public function update(StoreUpdateUser $request, String $id)
    {
        $input = $request->all();

        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'Usuário não encontrado.',
            ], 401);
        }
        $user->update($input);

        return response()->json([
            'message' => 'Usuário atualizado com sucesso.',
            'user' => $user
        ], 200);
    }

    public function delete(String $id) {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'Usuário não encontrado'
            ], 401);
        }

        User::destroy($id);

        return response()->json([
            'message' => 'Usuário deletado com sucesso.'
        ], 200);

    }

}
