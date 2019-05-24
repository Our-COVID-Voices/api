<?php

declare(strict_types=1);

namespace App\Docs;

use App\Docs\SecuritySchemes\OAuth2SecurityScheme;
use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityRequirement as BaseSecurityRequirement;

class SecurityRequirement extends BaseSecurityRequirement
{
    /**
     * @param string|null $objectId
     * @throws \GoldSpecDigital\ObjectOrientedOAS\Exceptions\InvalidArgumentException
     * @return \GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityRequirement
     */
    public static function create(string $objectId = null): BaseSecurityRequirement
    {
        return BaseSecurityRequirement::create($objectId)
            ->securityScheme(OAuth2SecurityScheme::create());
    }
}
