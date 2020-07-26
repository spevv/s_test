<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannedDomain  extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'domain'
    ];

    /**
     * Is banned
     *
     * @param string $domain
     *
     * @return bool
     */
    public function isBanned(string $domain): bool
    {
        return $this->newQuery()->where('domain', $domain)->exists();
    }
}
