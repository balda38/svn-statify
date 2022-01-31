<?php

namespace SvnStatify\Parser\Validators;

use SvnStatify\Exception\LogFileRevisionPathAttributeMissedException;

use SimpleXMLElement;

/**
 * Validate raw revision paths entry from xml `svn log` file.
 *
 * It's just check if xml contains required attributes for parsing and analyzing.
 *
 * @todo checking for not empty paths (maybe not be necessary)
 * @todo checking if `action` is in SvnStatify\Collection\Status consts
 */
class PathsValidator implements IValidator
{
    /**
     * @return string[]
     */
    private static function requiredAttributes() : array
    {
        return ['action'];
    }

    public static function validate(SimpleXMLElement $element) : void
    {
        foreach ($element->path as $path) {
            foreach (self::requiredAttributes() as $attribute) {
                if (!isset($path->attributes()->$attribute)) {
                    throw LogFileRevisionPathAttributeMissedException::forAttribute($attribute);
                }
            }
        }
    }
}
