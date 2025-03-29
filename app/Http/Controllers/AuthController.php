<?php

namespace App\Http\Controllers;

use App\Mail\NewUserConfirmation;
use App\Mail\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        // Valida formulário
        $credentials = $request->validate(
            [
                'email' => ['required', 'email', 'max:100'],
                'password' => ['required', 'min:8', 'max:32', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/']
            ],
            [
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um email válido.',
                'email.max' => 'O campo email deve ter no máximo 100 caracteres.',
                'password.required' => 'O campo senha é obrigatório.',
                'password.min' => 'O campo senha deve ter no mínimo :min caracteres.',
                'password.max' => 'O campo senha deve ter no máximo :max caracteres.',
                'password.regex' => 'O campo senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.'
            ]
        );

        // Verifica se user existe
        $user = User::where('email', $credentials['email'])
            ->where('active', true)
            ->where(function ($query) {
                $query->whereNull('blocked_until')
                    ->orWhere('blocked_until', '<=', now());
            })
            ->whereNotNull('email_verified_at')
            ->whereNull('deleted_at')
            ->first();

        if (!$user) {
            return back()->withInput()->with([
                'invalid_login' => 'Login inválido.'
            ]);
        }

        // Verifica se a password é válida
        if (!password_verify($credentials['password'], $user->password)) {
            return back()->withInput()->with([
                'invalid_login' => 'Login inválido.'
            ]);
        }

        // Atualiza o último login
        $user->last_login_at = now();
        $user->blocked_until = null;
        $user->save();

        // Realiza o login
        $request->session()->regenerate();
        Auth::login($user);

        // Redireciona após login
        return redirect()->intended(route('dashboard'));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function storeUser(Request $request): RedirectResponse|View
    {
        $request->validate(
            [
                'first_name' => ['required', 'max:100'],
                'last_name' => ['required', 'max:100'],
                'email' => ['required', 'email', 'max:100', 'unique:users,email'],
                'password' => ['required', 'min:8', 'max:32', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
                'password_confirmation' => ['required', 'same:password']
            ],
            [
                'first_name.required' => 'O campo nome é obrigatório.',
                'first_name.max' => 'O campo nome deve ter no máximo :max caracteres.',
                'last_name.required' => 'O campo sobrenome é obrigatório.',
                'last_name.max' => 'O campo sobrenome deve ter no máximo :max caracteres.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um email válido.',
                'email.max' => 'O campo email deve ter no máximo :max caracteres.',
                'email.unique' => 'O email informado já está em uso.',
                'password.required' => 'O campo senha é obrigatório.',
                'password.min' => 'O campo senha deve ter no mínimo :min caracteres.',
                'password.max' => 'O campo senha deve ter no máximo :max caracteres.',
                'password.regex' => 'O campo senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.',
                'password_confirmation.required' => 'O campo confirmação de senha é obrigatório.',
                'password_confirmation.same' => 'O campo confirmação de senha deve ser igual ao campo senha.'
            ]
        );

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        // Cria o token de verificação de email
        $user->token = Str::random(64);

        // Gerar link de confirmação e passa para dentro do email (que será enviado) que é uma view
        $confirmation_link = route('newUserConfirmation', ['token' => $user->token]);

        // Enviar email
        $result = Mail::to($user->email)
            ->send(new NewUserConfirmation($user->first_name, $confirmation_link));

        if (!$result) {
            return back()->withInput()->with([
                'server_error' => 'Erro ao enviar email de confirmação.'
            ]);
        }

        // Salva o usuário
        $user->save();

        // Redireciona após cadastro
        return view('auth.email_sent', ['email' => $user->email]);
    }

    public function newUserConfirmation($token): RedirectResponse|View
    {
        $user = User::where('token', $token)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        $user->email_verified_at = Carbon::now();
        $user->token = null;
        $user->active = true;
        $user->save();

        Auth::login($user);

        return view('auth.new_user_confirmed_success');
    }


    public function forgotPassword(): View
    {
        return view('auth.forgot_password');
    }

    public function sendForgotPasswordLink(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|email|max:100'
            ],
            [
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um email válido.',
                'email.max' => 'O campo email deve ter no máximo :max caracteres.'
            ]
        );

        $server_message = 'Se o email informado estiver cadastrado, um link para redefinição de senha será enviado.';

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with([
                'server_message' => $server_message
            ]);
        }

        $user->token = Str::random(64);

        $token_link = route('resetPassword', ['token' => $user->token]);

        $result = Mail::to($user->email)
            ->send(new ResetPassword($token_link, $user->first_name));

        if (!$result) {
            return back()->with([
                'server_message' => $server_message
            ]);
        }

        $user->save();

        return back()->with([
            'server_message' => $server_message
        ]);

    }

    public function resetPassword($token): View|RedirectResponse
    {
        $user = User::where('token', $token)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('auth.reset_password', ['token' => $token]);
    }

    public function resetPasswordUpdate(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'token' => 'required',
                'new_password' => ['required', 'min:8', 'max:32', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
                'new_password_confirmation' => ['required', 'same:new_password']
            ],
            [
                'new_password.required' => 'O campo senha é obrigatório.',
                'new_password.min' => 'O campo senha deve ter no mínimo :min caracteres.',
                'new_password.max' => 'O campo senha deve ter no máximo :max caracteres.',
                'new_password.regex' => 'O campo senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.',
                'new_password_confirmation.required' => 'O campo confirmação de senha é obrigatório.',
                'new_password_confirmation.same' => 'O campo confirmação de senha deve ser igual ao campo senha.'
            ],
        );

        $user = User::where('token', $request->token)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        $user->password = bcrypt($request->new_password);
        $user->token = null;
        $user->save();

        return redirect()->route('login')->with([
            'password_reset' => 'Senha alterada com sucesso.'
        ]);
    }
}
