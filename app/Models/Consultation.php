<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends Model
{
    use HasFactory;

    public const STATUSES = [
        "pending" => "pending",
        "seen" => "seen"
    ];

    protected $fillable = [
        "service_id",
        "patient_id",
        "doctor_id",
        "date",
        "description",
        "details",
        "charge"
    ];

    public function setDateAttribute($value)
    {
        if (!blank($value))
            $this->attributes["date"] = Carbon::parse($value);
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    public function getFormattedStatusAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return '<span class="badge badge-warning text-white">pending</span>';
                break;

            default:
                return "default";
                break;
        }
    }

    /**
     * Get the patient that owns the Consultation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the doctor that owns the Consultation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
