<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use App\Models\{Reservation, User};

class UserController extends Controller
{



    public function __construct()
    {
        // Crée un utilisateur par défaut si aucun utilisateur n'existe
        if (User::count() === 0) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('123456'), // mot de passe par défaut
            ]);
        }
    }

    // Affiche le formulaire login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traite la connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('users.index'); // dashboard admin
        }

        return back()->withErrors([
            'message' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

   

public function dashboard()
{
    $users = User::orderBy('id', 'desc')->paginate(10);
    $reservations = Reservation::orderBy('id', 'desc')->paginate(10); // récupère les réservations
    return view('admin.users.index', compact('users', 'reservations'));
}


    // Formulaire création utilisateur
    public function create()
    {
        return view('admin.users.create');
    }

    // Créer un utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès !');
    }

    // Formulaire édition utilisateur
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Mettre à jour utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès !');
    }

    // Supprimer utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès !');
    }
}
