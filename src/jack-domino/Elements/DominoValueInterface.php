<?php

namespace JackDomino\Elements;

/**
 * Class DominoValue
 *
 * @package JackDomino\Elements
 * @author Jack Kwakman <jjkwakman@gmail.com>
 */
interface DominoValueInterface
{

    /**
     * Get the value
     *
     * @return int
     */
    public function getValue() : int;

    /**
     * Is this tile playable?
     *
     * @return bool
     */
    public function isPlayable(): bool;

    /**
     * Mark as played
     * @return DominoValue
     */
    public function markAsPlayed(): DominoValue;

}