<?php

use Mlntn\Eternal\Deck;
use Mlntn\Eternal\Deckcode;
use PHPUnit\Framework\TestCase;

class DeckCodeTest extends TestCase
{

    protected $deck = "3 Vara's Favor (Set0 #35)
4 Seat of Cunning (Set0 #62)
4 Mirror Image (Set1 #217)
3 Dark Return (Set1 #250)
3 Annihilate (Set1 #269)
4 Feln Banner (Set1 #417)
10 Primal Sigil (Set1 #187)
3 Shadow Sigil (Set1 #249)
4 Crest of Cunning (Set3 #267)
4 Jotun Feast-Caller (Set3 #187)
4 Cabal Standard (Set4 #193)
4 Dusk Raider (Set4 #153)
4 Kerendon Merchant (Set4 #217)
2 Rindra's Choice (Set4 #261)
4 Caiphus, Wandering King (Set4 #309)
4 Savagery (Set5 #117)
4 Ripknife Assassin (Set1003 #13)
4 Shakedown (Set1004 #18)
3 Vara, Vengeance-Seeker (Set1004 #19)
--------------MARKET---------------
1 Dark Return (Set1 #250)
1 Annihilate (Set1 #269)
1 Feeding Time (Set1 #381)
1 Haunting Scream (Set1 #374)
1 Vara, Vengeance-Seeker (Set1004 #19)";

    protected $deck_without_names = "3 (Set0 #35)
4 (Set0 #62)
4 (Set1 #217)
3 (Set1 #250)
3 (Set1 #269)
4 (Set1 #417)
10 (Set1 #187)
3 (Set1 #249)
4 (Set3 #267)
4 (Set3 #187)
4 (Set4 #193)
4 (Set4 #153)
4 (Set4 #217)
2 (Set4 #261)
4 (Set4 #309)
4 (Set5 #117)
4 (Set1003 #13)
4 (Set1004 #18)
3 (Set1004 #19)
--------------MARKET---------------
1 (Set1 #250)
1 (Set1 #269)
1 (Set1 #381)
1 (Set1 #374)
1 (Set1004 #19)";

    protected $code = 'DAjBEA-BEB5GDB6HDBtIEBhNKB7FDB5HEDrIED7FEEhGEE5EEE5GCElIEE1JEF1DErfNEsfSDsfTCAABB6HBBtIBB9LBB2LBsfT';

    public function testValidDecode()
    {
        $deckcoder = new Deckcode;

        $deck = $deckcoder->getDeckFromCode($this->code);

        $simple = (string) $deck;

        $this->assertEquals($simple, $this->deck_without_names);
    }

    public function testValidEncode()
    {
        $deck = Deck::fromString($this->deck);

        $deckcoder = new Deckcode;

        $code = $deckcoder->getCodeFromDeck($deck);

        $this->assertEquals($code, $this->code);
    }

}