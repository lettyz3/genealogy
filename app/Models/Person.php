<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    // Définir la relation entre une personne et ses enfants
    public function children()
    {
        return $this->hasMany(Relationship::class, 'parent_id');
    }

    // Définir la relation entre une personne et ses parents
    public function parents()
    {
        return $this->hasMany(Relationship::class, 'child_id');
    }

    // Définir la relation entre une personne et son créateur (User)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function getDegreeWith($target_person_id)
    {
        // La personne courante
        $startPersonId = $this->id;
        
        // La file d'attente pour le BFS
        $queue = [
            ['person_id' => $startPersonId, 'degree' => 0]
        ];
        
        // Un tableau pour suivre les personnes déjà explorées
        $visited = [];

        while (!empty($queue)) {
            // Défile la personne actuelle et son degré
            $current = array_shift($queue);
            $currentPersonId = $current['person_id'];
            $currentDegree = $current['degree'];

            // Si on a atteint la personne cible
            if ($currentPersonId == $target_person_id) {
                return $currentDegree;
            }

            // Si le degré dépasse 25, on arrête la recherche
            if ($currentDegree >= 25) {
                return false;
            }

            // On marque la personne comme visitée
            if (!in_array($currentPersonId, $visited)) {
                $visited[] = $currentPersonId;

                // Recherche des relations avec la personne actuelle
                $relationships = DB::table('relationships')
                    ->where('person_id', $currentPersonId)
                    ->orWhere('related_person_id', $currentPersonId)
                    ->get();

                // On ajoute les personnes liées dans la queue
                foreach ($relationships as $relationship) {
                    $relatedPersonId = ($relationship->person_id == $currentPersonId)
                        ? $relationship->related_person_id
                        : $relationship->person_id;

                    // Si cette personne n'a pas encore été visitée, on l'ajoute à la queue
                    if (!in_array($relatedPersonId, $visited)) {
                        $queue[] = ['person_id' => $relatedPersonId, 'degree' => $currentDegree + 1];
                    }
                }
            }
        }

        // Si on a parcouru toute la queue sans trouver la personne cible, on retourne false
        return false;
    }
}
