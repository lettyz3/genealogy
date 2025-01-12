<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    use HasFactory;

    // Définir la relation entre une relation et le parent
    public function parent()
    {
        return $this->belongsTo(Person::class, 'parent_id');
    }

    // Définir la relation entre une relation et l'enfant
    public function child()
    {
        return $this->belongsTo(Person::class, 'child_id');
    }

    // Définir la relation entre une relation et son créateur (User)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
