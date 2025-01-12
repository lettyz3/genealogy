<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Models\User;

class PersonController extends Controller
{
    // Afficher la liste des personnes avec le nom de l'utilisateur qui les a créées
    public function index()
    {
        $people = Person::with('createdBy')->get(); // Charge les personnes avec l'utilisateur qui les a créées
        return view('people.index', compact('people'));
    }

    // Afficher une personne spécifique avec ses enfants et parents
    public function show($id)
    {
        $person = Person::with('children', 'parents')->findOrFail($id);
        return view('people.show', compact('person'));
    }

    // Afficher le formulaire pour créer une nouvelle personne
    public function create()
    {
        return view('people.create');
    }

    // Valider et enregistrer une nouvelle personne
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_names' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
        ]);
    
        // Formatage des données
        $firstName = ucfirst(strtolower($request->first_name));
        $middleNames = $request->middle_names ? ucfirst(strtolower($request->middle_names)) : null;
        $lastName = strtoupper($request->last_name);
        $birthName = $request->birth_name ? strtoupper($request->birth_name) : $lastName;
        $dateOfBirth = $request->date_of_birth ? date('Y-m-d', strtotime($request->date_of_birth)) : null;
    
        // Création de la personne
        Person::create([
            'first_name' => $firstName,
            'middle_names' => $middleNames,
            'last_name' => $lastName,
            'birth_name' => $birthName,
            'date_of_birth' => $dateOfBirth,
            'created_by' => auth()->id(), // L'ID de l'utilisateur authentifié
        ]);
    
        // Rediriger avec un message de succès
        return redirect()->route('people.index')->with('success', 'Personne créée avec succès.');
    }
    
}
