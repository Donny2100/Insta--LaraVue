<?php

namespace App\Models;

use App\Models\State;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {
    protected $table = 'countries';

    protected $fillable = [
        'name', 'slug', 'status'
    ];

    protected $hidden = [];

    protected $casts = [
        'category_id' => 'integer'
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;
    const DEFAULT = 1;

    public function getFullList() {
        return self::query()
            ->where('status', self::STATUS_ACTIVE)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function states() {
        return $this->hasMany(State::class);
    }
}
