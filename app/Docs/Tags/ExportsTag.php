<?php

declare(strict_types=1);

namespace App\Docs\Tags;

use GoldSpecDigital\ObjectOrientedOAS\Objects\BaseObject;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;

class ExportsTag extends Tag
{
    /**
     * @param string|null $objectId
     * @return \GoldSpecDigital\ObjectOrientedOAS\Objects\Tag
     */
    public static function create(string $objectId = null): BaseObject
    {
        return parent::create($objectId)
            ->name('Exports');
    }
}
