# Eternal Deckcodes

This library converts Eternal deck codes to - and from - very simple classes.

## Installation

```bash
composer require mlntn/eternal-deckcodes
```

## Get a deck from a code

```php
use Mlntn\Eternal\Deckcode;

$dc = new Deckcode;

$deck = $dc->getDeckFromCode('DAjBEA-BEB5GDB6HDBtIEBhNKB7FDB5HEDrIED7FEEhGEE5EEE5GCElIEE1JEF1DErfNEsfSDsfTCAABB6HBBtIBB9LBB2LBsfT');
```

#### Result
```
object(Mlntn\Eternal\Deck)#384 (3) {
  ["main"]=>
  array(19) {
    [0]=>
    object(Mlntn\Eternal\Card)#53 (3) {
      ["set_id"]=>
      int(0)
      ["card_id"]=>
      int(35)
      ["count"]=>
      int(3)
    }
    [1]=>
    object(Mlntn\Eternal\Card)#54 (3) {
      ["set_id"]=>
      int(0)
      ["card_id"]=>
      int(62)
      ["count"]=>
      int(4)
    }
    ...
  }
  ["market"]=>
  array(5) {
    [0]=>
    object(Mlntn\Eternal\Card)#70 (3) {
      ["set_id"]=>
      int(1)
      ["card_id"]=>
      int(250)
      ["count"]=>
      int(1)
    }
    ...
  }
```

## Get a code from a deck string
```php
use Mlntn\Eternal\Card;
use Mlntn\Eternal\Deck;
use Mlntn\Eternal\Deckcode;

$contents = <<<DECK
3 Vara's Favor (Set0 #35)
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
1 Vara, Vengeance-Seeker (Set1004 #19)
DECK;

$deck = Deck::fromString($contents);

$dc = new Deckcode;
$code = $dc->getCodeFromDeck($deck);
```

#### Result
```
DAjBEA-BEB5GDB6HDBtIEBhNKB7FDB5HEDrIED7FEEhGEE5EEE5GCElIEE1JEF1DErfNEsfSDsfTCAABB6HBBtIBB9LBB2LBsfT
```

## Get a code from a deck

```php
use Mlntn\Eternal\Card;
use Mlntn\Eternal\Deck;
use Mlntn\Eternal\Deckcode;

$deck = new Deck;
$deck->addCard(new Card(3, 0, 35));
$deck->addCard(new Card(4, 0, 62));
$deck->addCard(new Card(4, 1, 217));
$deck->addCard(new Card(3, 1, 250));
$deck->addCard(new Card(3, 1, 269));
$deck->addCard(new Card(4, 1, 417));
$deck->addCard(new Card(10, 1, 187));
$deck->addCard(new Card(3, 1, 249));
$deck->addCard(new Card(4, 3, 267));
$deck->addCard(new Card(4, 3, 187));
$deck->addCard(new Card(4, 4, 193));
$deck->addCard(new Card(4, 4, 153));
$deck->addCard(new Card(4, 4, 217));
$deck->addCard(new Card(2, 4, 261));
$deck->addCard(new Card(4, 4, 309));
$deck->addCard(new Card(4, 5, 117));
$deck->addCard(new Card(4, 1003, 13));
$deck->addCard(new Card(4, 1004, 18));
$deck->addCard(new Card(3, 1004, 19));
$deck->addCard(new Card(1, 1, 250));
$deck->addCard(new Card(1, 1, 269));
$deck->addCard(new Card(1, 1, 381));
$deck->addCard(new Card(1, 1, 374));
$deck->addCard(new Card(1, 1004, 19));

$dc = new Deckcode;
$code = $dc->getCodeFromDeck($deck);
```

#### Result
```
DAjBEA-BEB5GDB6HDBtIEBhNKB7FDB5HEDrIED7FEEhGEE5EEE5GCElIEE1JEF1DErfNEsfSDsfTCAABB6HBBtIBB9LBB2LBsfT
```
