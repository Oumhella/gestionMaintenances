<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonFormData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'fonction',
        'due_date',
        'equipement',
        'form_type',
    ];

    // Relationship to specific form data (e.g., CoffretsInformatique)
    public function coffretsInformatiqueData(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CoffretsInformatique::class, 'common_data_id');
    }
    public function gtcData(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GTC::class, 'common_data_id');
    }
    public function geData(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GE::class, 'common_data_id');
    }
    public function pcsData(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PCS::class, 'common_data_id');
    }
    public function eauData(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Eau::class, 'common_data_id');
    }
    public function electriqueData(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Electrique::class, 'common_data_id');
    }
}
