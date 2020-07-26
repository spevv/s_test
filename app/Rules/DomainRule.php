<?php

namespace App\Rules;

use App\BannedDomain;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class DomainRule
 * @package App\Rules
 */
class DomainRule implements Rule
{
    /**
     * @var BannedDomain
     */
    private $bannedDomain;

    /**
     * DomainRule constructor.
     *
     * @param BannedDomain $bannedDomain
     */
    public function __construct(BannedDomain $bannedDomain)
    {
        $this->bannedDomain = $bannedDomain;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        return $this->bannedDomain->isBanned(substr($value, strpos($value, '@') + 1));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The domain name is banned.';
    }
}
