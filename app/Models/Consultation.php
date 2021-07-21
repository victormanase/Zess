<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Consultation extends Model
{
    use HasFactory;

    private $defaultRow = [[
        "key" => 1,
        "content" => ""
    ]];

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
        "charge",

        'case_no',
        'policy_no',
        'c_o',
        'hx_of_presenting_illness',
        'past_medical_hx',
        'any_known_allergies',
        'o_e',
        'bp',
        'rr',
        'spo2',
        'pr',
        'temp',
        'height',
        'weight',
        'fbs_rbg',

        'rs',
        'cvs',
        'pa',
        'cns',
        'others',
        'doctors_advice',
    ];

    /**
     * Get the service that owns the Consultation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

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

    /**
     * Get all of the investigations for the Consultation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function investigations(): HasMany
    {
        return $this->hasMany(ConsultationInvestigation::class);
    }

    public function getInvestigationsFormattedAttribute()
    {
        $investigations = $this->investigations->map(fn ($investigation, $index) => ["key" => $index, "content" => $investigation->content]);
        return blank($investigations) ? $this->defaultRow : $investigations;
    }

    /**
     * Get all of the plans for the Consultation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plans(): HasMany
    {
        return $this->hasMany(ConsultationPlan::class);
    }

    public function getPlansFormattedAttribute()
    {
        $plans = $this->plans->map(fn ($plan, $index) => ["key" => $index, "content" => $plan->content]);
        return blank($plans) ? $this->defaultRow : $plans;
    }

    /**
     * Get all of the pds for the Consultation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pds(): HasMany
    {
        return $this->hasMany(ConsultationPd::class);
    }

    public function getPdsFormattedAttribute()
    {
        $pds = $this->pds->map(fn ($pd, $index) => ["key" => $index, "content" => $pd->content]);
        return blank($pds) ? $this->defaultRow : $pds;
    }

    public function getInvoiceNoAttribute()
    {
        $length = 7;
        return "#".substr(str_repeat(0, $length).$this->id, - $length);
    }
}
