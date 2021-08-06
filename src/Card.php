<?php

namespace Mlntn\Eternal;

class Card {

    /**
     * @var integer
     */
    public $set_id;

    /**
     * @var integer
     */
    public $card_id;

    /**
     * @var integer
     */
    public $count;

    /**
     * @param $set_id
     * @param $card_id
     * @param integer $count
     */
    public function __construct($count, $set_id, $card_id)
    {
        $this->count   = (int) $count;
        $this->set_id  = (int) $set_id;
        $this->card_id = (int) $card_id;
    }

    public function __toString()
    {
        return "{$this->count} (Set{$this->set_id} #{$this->card_id})";
    }

}