<?php

namespace JackDomino\Game;

use JackDomino\Elements\DominoPool;
use JackDomino\Elements\Domino;

/**
 * Interface GameInterface
 *
 * @package JackDomino\Game
 * @author Jack Kwakman <jjkwakman@gmail.com>
 */
interface GameInterface
{
    /**
     * Start a new game
     */
    public function start();

    /**
     * Make a turn
     *
     * @param Player $player
     * @return bool
     */
    public function turn(Player $player) : bool;

    /**
     * Get tile from stack
     *
     * @param DominoPool $stack
     * @return Domino|null
     */
    public function getTileFromStack(DominoPool $stack): ? Domino;

    /**
     * Check if a player has won
     *
     * @param Player $player
     * @return bool
     */
    public function hasWon(Player $player): bool;

    /**
     * Check if a game is blocked
     *
     * @param DominoPool $stack
     * @return bool
     */
    public function isBlocked(DominoPool $stack): bool;
}
