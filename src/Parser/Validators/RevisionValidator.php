<?php

namespace SvnStatify\Parser\Validators;

use SvnStatify\Exception\LogFileRevisionAttributeMissedException;
use SvnStatify\Exception\LogFileRevisionChildElementMissedException;

use SimpleXMLElement;

/**
 * Validate raw revision entry from xml `svn log` file.
 *
 * It's just check if xml contains required attributes for parsing and analyzing.
 */
class RevisionValidator implements IValidator
{
    /**
     * @return string[]
     */
    private static function requiredAttributes() : array
    {
        return ['revision'];
    }

    /**
     * @return string[]
     */
    private static function requiredChildrens() : array
    {
        return ['author', 'date', 'paths', 'msg'];
    }

    /**
     * @throws LogFileRevisionAttributeMissedException
     * @throws LogFileRevisionChildElementMissedException
     */
    public static function validate(SimpleXMLElement $revision) : void
    {
        foreach (self::requiredAttributes() as $attribute) {
            if (!isset($revision->attributes()->$attribute)) {
                throw LogFileRevisionAttributeMissedException::forAttribute($attribute);
            }
        }

        foreach (self::requiredChildrens() as $child) {
            if (!isset($revision->$child)) {
                throw LogFileRevisionChildElementMissedException::forChild($child);
            }
            if ($child === 'paths') {
                PathsValidator::validate($revision->$child);
            }
        }
    }
}
