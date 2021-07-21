<?php

namespace App\Models;

use App\Utils\Traits\HasUserAtributes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory, HasUserAtributes;

    protected $fillable = [
        "user_id",
        "client_id",
        "patient_type_id",
        "date_of_birth",
        "gender",
        "address"
    ];


    public function setDateOfBirthAttribute($value)
    {
        if (!blank($value))
            $this->attributes["date_of_birth"] = Carbon::parse($value);
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value) : Carbon::today();
    }

    public function getAgeAttribute()
    {
        $today = Carbon::today();
        $dob = $this->date_of_birth;
        $diff = $today->diff($dob);
        return "$diff->y years";
    }

    /**
     * Get the user that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the client that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the patientType that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patientType(): BelongsTo
    {
        return $this->belongsTo(PatientType::class);
    }

    /**
     * Get all of the consultations for the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }
}
