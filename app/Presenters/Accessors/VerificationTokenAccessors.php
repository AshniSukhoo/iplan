<?php

namespace Iplan\Presenters\Accessors;

trait VerificationTokenAccessors
{
    /**
     * Return Verification URL.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('actions.verify-user-account', [
            'verificationToken' => $this->token
        ]);
    }
}
