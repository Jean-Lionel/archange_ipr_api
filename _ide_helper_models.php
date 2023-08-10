<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Adresse
 *
 * @mixin IdeHelperAdresse
 * @property int $id
 * @property string|null $zipcode
 * @property string|null $region
 * @property string|null $district
 * @property string|null $city
 * @property string|null $oldzipcode
 * @property string $pays
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AdresseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse whereOldzipcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse wherePays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Adresse whereZipcode($value)
 */
	class Adresse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Contribuable
 *
 * @mixin IdeHelperContribuable
 * @property int $id
 * @property string $title
 * @property int $adresse_id
 * @property string $nif
 * @property string|null $damaine_activity
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employe> $employes
 * @property-read int|null $employes_count
 * @method static \Database\Factories\ContribuableFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Contribuable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contribuable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contribuable query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contribuable whereAdresseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contribuable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contribuable whereDamaineActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contribuable whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contribuable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contribuable whereNif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contribuable whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contribuable whereUpdatedAt($value)
 */
	class Contribuable extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Employe
 *
 * @mixin IdeHelperEmploye
 * @property int $id
 * @property string|null $cni
 * @property string|null $nom
 * @property string|null $prenom
 * @property string|null $status_employe
 * @property float $salaire_base
 * @property float|null $frais_deplacement
 * @property float|null $cotisations
 * @property float|null $indeminite_compansatoire
 * @property float|null $avantage_en_nature
 * @property int $contribuable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contribuable $contribuable
 * @method static \Database\Factories\EmployeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Employe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Employe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereAvantageEnNature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereCni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereContribuableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereCotisations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereFraisDeplacement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereIndeminiteCompansatoire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereSalaireBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereStatusEmploye($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Employe whereUpdatedAt($value)
 */
	class Employe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaimentIpr
 *
 * @mixin IdeHelperPaimentIpr
 * @property int $id
 * @property int $contribuable_id
 * @property int $employe_id
 * @property \Illuminate\Support\Carbon $date_paiement
 * @property float $montant_employe
 * @property float $base_imposable
 * @property float $remuneration_brut
 * @property float $inss
 * @property float $mfp
 * @property float $IPR
 * @property float $montant_employeur
 * @property float|null $total_paiement
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contribuable $contribuable
 * @method static \Database\Factories\PaimentIprFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereBaseImposable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereContribuableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereDatePaiement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereEmployeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereIPR($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereInss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereMfp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereMontantEmploye($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereMontantEmployeur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereRemunerationBrut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereTotalPaiement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaimentIpr whereUpdatedAt($value)
 */
	class PaimentIpr extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TauxImposamble
 *
 * @mixin IdeHelperTauxImposamble
 * @property int $id
 * @property \Illuminate\Support\Carbon $date
 * @property float $min_montant
 * @property float $max_montant
 * @property float $taux_imposamble
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TauxImposambleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TauxImposamble newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TauxImposamble newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TauxImposamble query()
 * @method static \Illuminate\Database\Eloquent\Builder|TauxImposamble whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TauxImposamble whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TauxImposamble whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TauxImposamble whereMaxMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TauxImposamble whereMinMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TauxImposamble whereTauxImposamble($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TauxImposamble whereUpdatedAt($value)
 */
	class TauxImposamble extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $name
 * @property string|null $username
 * @property string|null $role
 * @property string|null $phone
 * @property int|null $contriuable_id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContriuableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

