<?php

declare(strict_types=1);

/*
 * This file is part of DOCtor-RST.
 *
 * (c) Oskar Stark <oskarstark@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Rule;

use App\Annotations\Rule\Description;
use App\Annotations\Rule\InvalidExample;
use App\Annotations\Rule\ValidExample;
use App\Handler\Registry;
use App\Value\Lines;
use App\Value\RuleGroup;

/**
 * @Description("Ensure only American English is used.")
 * @InvalidExample("This is a nice behaviour...")
 * @ValidExample("This is a nice behavior...")
 */
class AmericanEnglish extends CheckListRule
{
    public static function getGroups(): array
    {
        return [
            RuleGroup::fromString(Registry::GROUP_SONATA),
            RuleGroup::fromString(Registry::GROUP_SYMFONY),
        ];
    }

    public function check(Lines $lines, int $number): ?string
    {
        $lines->seek($number);
        $line = $lines->current();

        if (preg_match($this->pattern, $line->raw(), $matches)) {
            return sprintf($this->message, $matches[0]);
        }

        return null;
    }

    public function getDefaultMessage(): string
    {
        return 'Please use American English for: %s';
    }

    /**
     * @return array<string, null>
     */
    public static function getList(): array
    {
        return [
            '/(B|b)ehaviour(s)?/' => null,
            '/(I|i)nitialise/i' => null,
            '/normalise/i' => null,
            '/organise/i' => null,
            '/recognise/i' => null,
            '/centre/i' => null,
            '/colour/i' => null,
            '/flavour/i' => null,
            '/licence/i' => null,
        ];
    }
}
