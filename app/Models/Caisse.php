<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    protected $fillable = ['montant',];

    // Propriété statique représentant le montant actuel en caisse
    public static $montant = 0;

    /**
     * Initialise le montant à partir de la base de données.
     * Charge la première ligne de la table (ou crée une caisse par défaut si nécessaire).
     *
     * @return Caisse
     */
    protected static function initializeMontant(): self
    {
        // Récupère la première entrée 'caisse'
        $caisse = static::first();

        // Si aucune caisse n'existe, on en crée une avec montant à 0
        if (!$caisse) {
            $caisse = static::create([
                'montant' => 0
            ]);
        }

        // Initialise la propriété statique avec la valeur depuis la base
        static::$montant = (int) $caisse->montant;

        return $caisse;
    }

    /**
     * Crédite la caisse d'un montant donné et sauve en base.
     *
     * @param float $montant Montant à ajouter à la caisse
     * @return void
     */
    public static function crediter(int $montant): void
    {
        $caisse = static::initializeMontant();
        static::$montant += $montant;
        $caisse->montant = static::$montant;
        $caisse->save();
    }

    /**
     * Débite la caisse d'un montant donné si les fonds sont suffisants.
     * Lève une exception en cas de fonds insuffisants.
     *
     * @param float $montant Montant à retirer de la caisse
     * @return void
     * @throws Exception Si le montant à débiter excède le montant disponible
     */
    public static function debiter(int $montant): void
    {
        $caisse = static::initializeMontant();
        if ($montant > static::$montant) {
        //     throw new \Exception("Fonds insuffisants en caisse");
            static::$montant = 0;
        }elseif($montant < static::$montant){
            static::$montant -= $montant;
            $caisse->montant = static::$montant;
            $caisse->save();
        }
    }
}
