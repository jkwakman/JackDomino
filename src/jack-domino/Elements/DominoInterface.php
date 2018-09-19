<?php

namespace JackDomino\Elements;

/**
 * Domino interface
 *
 * @package JackDomino\Elements
 * @author Jack Kwakman <jjkwakman@gmail.com>
 */
interface DominoInterface
{

    /**
     * Reverse the domino
     *
     * @return DominoValue[]
     */
    public function reverse() : array;

    /**
     * Get values
     *
     * @return DominoValue[]
     */
    public function getValues(): array;

    /**
     * Get playable values
     *
     * @param array $playableValues
     * @param string $mode
     * @return DominoValue[]
     */
    public function getPlayableValues(array $playableValues = array(), string $mode = 'value'): array;

    /**
     * Mark a domino as played by value
     *
     * @param int $value
     * @param int|bool $position
     * @return DominoValue|null
     */
    public function markAsPlayed(int $value, $position = false):? DominoValue;

}