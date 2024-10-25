<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Si le nom de l'identifiant personnalisé est 'category_id'
    protected $primaryKey = 'category_id';

    // Indique que la clé primaire est auto-incrémentée
    public $incrementing = true;

    // Ne spécifie pas le type de clé primaire ici
    // protected $keyType = 'bigint'; // Supprime cette ligne

    // Colonnes qui peuvent être massivement assignées
    protected $fillable = ['category_name'];

    public function tracks()
    {
        return $this->hasMany(Track::class); // Relation : une catégorie a plusieurs pistes
    }
}
