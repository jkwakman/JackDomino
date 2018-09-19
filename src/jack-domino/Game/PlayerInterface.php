<?php

namespace JackDomino\Game;

use JackDomino\Elements\DominoPool;

/**
 * Interface PlayerInterface
 *
 * @package JackDomino\Game
 * @author Jack Kwakman <jjkwakman@gmail.com>
 */
interface PlayerInterface
{

    /**
     * Show hand
     *
     * @return string
     */
    public function showHand(): string;
}