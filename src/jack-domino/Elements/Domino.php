<?php

namespace JackDomino\Elements;

/**
 * Class Domino
 *
 * Main class for generating a domino
 *
 * @package JackDomino\Elements
 * @author Jack Kwakman <jjkwakman@gmail.com>
 */
final class Domino implements DominoInterface
{

    /**
     * @var string
     */
    const TILE = '<%s:%s>';

    /**
     * @var DominoValue[]
     */
    private $values = array();

    /**
     * Domino constructor.
     * @param int $head
     * @param int $tail
     */
    public function __construct(int $head, int $tail)
    {

        $this->values[] = new DominoValue($head);
        $this->values[] = new DominoValue($tail);
    }

    /**
     * Get the domino head, tail pair name
     *
     * @return string
     */
    public function __toString(): string
    {

        return sprintf($this::TILE, $this->values[0], $this->values[1]);
    }

    /**
     * Reverse the domino
     *
     * @return DominoValue[]
     */
    public function reverse(): array
    {

        $this->values = array_reverse($this->values);

        return $this->values;
    }

    /**
     * Get values
     *
     * @return DominoValue[]
     */
    public function getValues(): array
    {

        return $this->values;
    }

    /**
     * Get playable values
     *
     * @param array $playableValues
     * @param string $mode
     * @return DominoValue[]
     */
    public function getPlayableValues(array $playableValues = array(), string $mode = 'value'): array
    {

        foreach ($this->values as $key => $value) {

            if ($value->isPlayable()) {
                if ($mode == 'object') {
                    $playableValues[] = $value;
                } else {
                    $playableValues[] = (string)$value;
                }
            }
        }

        return $playableValues;
    }

    /**
     * Mark a domino as played by value
     *
     * @param int $value
     * @param int|bool $position
     * @return DominoValue|null
     */
    public function markAsPlayed(int $value, $position = false):? DominoValue
    {

        //Loop through the playable values
        foreach ($this->getPlayableValues(array(), 'object') as $key => $dominoValue) {

            if ($value == $dominoValue->getValue()) {
                //Reverse the domino when it is in the wrong position
                if (($position === 0 && $key == 0) || ($position > 0 && $key == 1)) {
                    $this->reverse();
                }

                $dominoValue->markAsPlayed();

                return $dominoValue;
            }
        }

        return null;
    }
}
