<?php

namespace Mlntn\Eternal;

class Deckcode {

	/**
	 * @param Deck $deck
	 *
	 * @return string
	 */
	public function getCodeFromDeck(Deck $deck)
	{
		$ints = [ ];

		foreach ($deck->main as $card) {
		    $ints = array_merge($ints, [ $card->count, $card->set_id, $card->card_id ]);
		}

		if (count($deck->market)) {
		    $ints = array_merge($ints, [ 2, 0, 0 ]);
        }

		foreach ($deck->market as $card) {
		    $ints = array_merge($ints, [ $card->count, $card->set_id, $card->card_id ]);
        }

		return $this->encode($ints);
	}

    /**
     * @param string $code
     *
     * @return Deck
     * @throws InvalidLocationException
     */
	public function getDeckFromCode($code)
	{
		$data = $this->decode($code);

        $deck = new Deck;

        $length = count($data);

		$location = 'main';

		for ($i = 0; $i < $length; $i += 3) {
		    list($count, $set_id, $card_id) = array_slice($data, $i, 3);

		    if ($set_id === 0 && $card_id === 0 && $count === 2) {
		        $location = 'market';
		        continue;
            }

		    $deck->addCard(new Card($count, $set_id, $card_id), $location);
        }

		return $deck;
	}

    protected function encode($values) {
        $error = null;

        $code = '';
        foreach ($values as $index => $i) {
            if ($error) {
                continue;
            }

            if ($i < 0) {
                $error = "negative value";
                continue;
            }

            if ($i === 0) {
                $code = $code . "A";
            }

            while ($i > 0) {
                $r = $i % 32;
                $i = ($i - $r) / 32;

                if ($i > 0) {
                    $r = $r + 32;
                }

                if ($r < 26) {
                    $code = $code . chr(65 + $r);
                } else if ($r < 52) {
                    $code = $code . chr(97 + $r - 26);
                } else if ($r < 62) {
                    $code = $code . chr(48 + $r - 52);
                } else if ($r === 62) {
                    $code = $code . '-';
                } else if ($r === 63) {
                    $code = $code . '_';
                }
            }
        }

        if ($error) {
            return null;
        }

        return $code;
    }

    protected function decode($code) {
        $values = [];
        $i      = 0;
        $m      = 1;

        for ($ix = 0; $ix < strlen($code); $ix += 1) {
            $c = $code[$ix];

            if ($c === '-') {
                $r = 62;
            } else if ($c === '_') {
                $r = 63;
            } else {
                $charCode = ord($c);

                if ($charCode >= 97) {
                    $r = $charCode - 97 + 26;
                } else if ($charCode >= 65) {
                    $r = $charCode - 65;
                } else {
                    $r = $charCode - 48 + 52;
                }
            }

            if ($r >= 32) {
                $i = $i + $m * ($r % 32);
                $m = $m * 32;
            } else {
                $i        = $i + $m * $r;
                $values[] = $i;

                $i = 0;
                $m = 1;
            }
        }

        if ($m !== 1) {
            return null;
        }

        return $values;
    }
}