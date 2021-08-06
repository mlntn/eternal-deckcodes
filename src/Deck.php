<?php

namespace Mlntn\Eternal;

class Deck {

	/**
	 * @var Card[]
	 */
	public $main = [];

	/**
	 * @var Card[]
	 */
	public $market = [];

    /**
     * @param Card $card
     * @param string $location
     *
     * @throws \Exception
     */
	public function addCard(Card $card, $location = 'main')
	{
	    if (! in_array($location, ['main', 'market'])) {
	        throw new InvalidLocationException;
        }

		$this->$location[] = $card;
	}

    /**
     * @param string $contents
     *
     * @return static
     * @throws \Exception
     */
	public static function fromString($contents)
    {
        $lines = preg_split('~\R~', trim($contents));

        $deck = new static;

        $location = 'main';

        foreach ($lines as $line) {
            $line = trim($line);

            if (preg_match('~^-+MARKET-+$~', trim($line))) {
                $location = 'market';
                continue;
            }

            preg_match('~^(\d+).+?\(Set(\d+) #(\d+)\)$~', trim($line), $parts);

            [, $count, $set_id, $card_id] = $parts;

            $card = new Card($count, $set_id, $card_id);

            $deck->addCard($card, $location);
        }

        return $deck;
    }

    public function __toString()
    {
        $return = [];

        foreach ($this->main as $card) {
            $return[] = (string) $card;
        }

        if (count($this->market)) {
            $return[] = '--------------MARKET---------------';
            foreach ($this->market as $card) {
                $return[] = (string) $card;
            }
        }

        return implode("\n", $return);
    }

}