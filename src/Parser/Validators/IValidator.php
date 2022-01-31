<?php

namespace SvnStatify\Parser\Validators;

use SimpleXMLElement;

interface IValidator
{
    public static function validate(SimpleXMLElement $element) : void;
}
