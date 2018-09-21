<?php

namespace JackDomino\Elements;

/**
 * Class DominoValue
 *
 * Each domino consists of two domino values.
 *
 * @package JackDomino\Elements
 * @author Jack Kwakman <jjkwakman@gmail.com>
 */
final class DominoValue implements DominoValueInterface
{

    /**
     * @var int
     */
    protected $value;

    /**
     * @var bool
     */
    protected $playable;

    /**
     * DominoValue constructor.
     *
     * @param int $value
     * @param bool $playable
     */
    public function __construct(int $value, bool $playable = true)
    {

        $this->value = $value;
        $this->playable = $playable;
    }

    /**
     * Return value as string
     *
     * @return string
     */
    public function __toString(): string
    {
        
        return (string)$this->value;
    }

    /**
     * Get the value
     *
     * @return int
     */
    public function getValue(): int
    {
        
        return $this->value;
    }

    /**
     * Is this tile playable?
     *
     * @return bool
     */
    public function isPlayable(): bool
    {
        
        return $this->playable;
    }

    /**
     * Mark as played
     * @return DominoValue
     */
    public function markAsPlayed(): DominoValue
    {
        
        $this->playable = false;

        return $this;
    }
}
