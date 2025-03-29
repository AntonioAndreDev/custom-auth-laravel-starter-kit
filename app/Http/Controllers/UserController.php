<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {

        $user = Auth::user();

        $data = $request->validate(
            [
                'current_password' => 'required|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'new_password' => 'required|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'new_password_confirmation' => 'required|same:new_password'
            ],
            [
                'current_password.required' => 'Você precisa informar a senha atual para alterá-la.',
                'current_password.min' => 'A senha deve ter no mínimo :min caracteres.',
                'current_password.max' => 'A senha deve ter no mínimo :max caracteres.',
                'current_password.regex' => 'A senha deve conter ao menos uma letra maiúscula, uma letra minúscula e um número.',
                'new_password.regex' => 'A senha deve conter ao menos uma letra maiúscula, uma letra minúscula e um número.',
                'new_password.min' => 'A senha deve ter no mínimo :min caracteres.',
                'new_password.max' => 'A senha deve ter no mínimo :max caracteres.',
                'new_password.required' => 'Você precisa informar a nova senha.',
                'new_password_confirmation.required' => 'Você precisa confirmar a nova senha.',
                'new_password_confirmation.same' => 'As senhas não conferem.'
            ]
        );

        if (!password_verify($data['current_password'], $user->password)) {
            return back()->withInput()->with([
                'server_error' => 'Senha atual inválida.'
            ]);
        }

        $user->password = bcrypt($data['new_password']);
        $user->save();

        return redirect()->route('profile')->with('success', 'Senha alterada com sucesso.');


    }

    public function deleteAccount(Request $request): RedirectResponse
    {

        $request->validate(
            [
                "delete_account_confirmation" => "required|in:DELETE MY ACCOUNT"
            ],
            [
                "delete_account_confirmation.required" => "Você precisa confirmar a exclusão da sua conta.",
                "delete_account_confirmation.in" => "Para deletar a sua conta você precisa digitar 'DELETE MY ACCOUNT'."
            ]
        );


        // Soft delete (no model User precisa usar o use SoftDeletes;)
        $user = Auth::user();
        $user->delete();

        // Hard delete
//        $user = Auth::user();
//        $user->forceDelete();

        Auth::logout();

        return redirect()->route('login')->with('account_deleted', 'Conta deletada com sucesso.');
    }
}
