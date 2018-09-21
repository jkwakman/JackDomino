<?php

namespace JackDomino\Game;

use JackDomino\Elements\DominoPool;

/**
 * Class Player
 *
 * Use this class to create a player for a nice game of domino's
 *
 * @package JackDomino\Game
 * @author Jack Kwakman <jjkwakman@gmail.com>
 */
final class Player implements PlayerInterface
{

     /**
     * @var string
     */
    private $name;

    /**
     * @var DominoPool
     */
    public $dominoPool;

    /**
     * Initialize a player
     *
     * @param string $name
     * @param DominoPool $dominoPool
     */
    public function __construct(string $name, DominoPool $dominoPool)
    {

        $this->name = $name;
        $this->dominoPool = $dominoPool;
    }

    /**
     * Get the ployer name
     *
     * @return string
     */
    public function __toString(): string
    {

        return $this->name;
    }

    /**
     * Show hand
     *
     * @return string
     */
    public function showHand(): string
    {

        return (string)$this->dominoPool;
    }
}
