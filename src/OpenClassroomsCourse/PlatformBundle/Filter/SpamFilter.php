<?php

declare(strict_types=1);

namespace OpenClassroomsCourse\PlatformBundle\Filter;

class SpamFilter
{
    /**
     * @var int The minimum length of the text.
     */
    private $minLength;

    /**
     * @param int $minLength
     */
    public function __construct(int $minLength)
    {
        $this->minLength = $minLength;
    }

    /**
     * Checks if the text is spam.
     *
     * @param string $text
     *
     * @return bool
     */
    public function isSpam(string $text): bool
    {
        return strlen($text) < $this->minLength;
    }
}