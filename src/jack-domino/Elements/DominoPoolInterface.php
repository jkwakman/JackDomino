<?php

namespace JackDomino\Elements;

/**
 * Domino pool interface
 *
 * @package JackDomino\Elements
 * @author Jack Kwakman <jjkwakman@gmail.com>
 */
interface DominoPoolInterface
{
    /**
     * Add a domino to the pool
     *
     * @param Domino $domino
     * @param int $position
     * @return Domino[]
     */
    public function add(Domino $domino, $position = 0): array;

    /**
     * Shuffle the domino pool
     *
     * @return Domino[]
     */
    public function shuffle(): array;

    /**
     * Clear the pool
     * @return Domino[]
     */
    public function clear(): array;

    /**
     * Pick random number of items from array
     *
     * @param int $amount
     * @return Domino[]|null
     */
    public function pickRandom(int $amount = 1): ? array;

    /**
     * Pick with value (remove from pool)
     *
     * @param int $value
     * @return Domino|null
     */
    public function pickWithValue(int $value): ? Domino;

    /**
     * Get playable values
     *
     * @param string $mode
     * @return array
     */
    public function getPlayableValues(string $mode = 'value'): array;

    /**
     * Mark a domino as played by value
     *
     * @param int $value
     * @return DominoValue|null
     */
    public function markAsPlayed(int $value): ? DominoValue;

    /**
     * Play the tile
     *
     * @param Domino
     * @param integer $position
     * @return Domino|null
     */
    public function play(Domino $domino, int $position): ? Domino;

    /**
     *  Get a domino tile by position in the pool
     *
     * @param int $position
     * @return Domino|null
     */
    public function getDominoByPosition(int $position): ? Domino;

    /**
     * Get position by value (only playable)
     *
     * @param int $value
     * @return int|null
     */
    public function getPosition(int $value): ? int;

    /**
     * Get full set
     *
     * @return Domino[]
     */
    public function getFullSet(): array;
}
