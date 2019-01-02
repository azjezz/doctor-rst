<?php

declare(strict_types=1);

/*
 * This file is part of the rst-checker.
 *
 * (c) Oskar Stark <oskarstark@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Rule\Sonata;

use App\Rule\Rule;

class NoPhpPrefixBeforeBinConsole implements Rule
{
    public function supportedExtensions(): array
    {
        return ['rst'];
    }

    public function check(\ArrayIterator $lines, int $number)
    {
        $lines->seek($number);
        $line = $lines->current();

        if (strstr($line, 'php bin/console')) {
            return 'Please remove "php" prefix before "bin/console"';
        }
    }
}