<?php

declare(strict_types=1);

/**
 * Copyright (c) 2018-2025 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/phpstan-rules
 */

namespace Ergebnis\PHPStan\Rules;

/**
 * @internal
 */
final class ClassName
{
    private string $value;

    /**
     * @param class-string $value
     */
    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param class-string $value
     */
    public static function fromString(string $value): self
    {
        return new self($value);
    }

    /**
     * @return class-string
     */
    public function toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
