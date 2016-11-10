<?php

namespace TestCode\Event;

use JMS\Serializer\Annotation as Serializer;

class Employee extends AbstractEvent
{

    protected $amount;

    public function __construct(\DateTime $datetime, $amount)
    {
        parent::__construct($datetime);
        $this->amount = $amount;
    }

    protected static function getType() : string
    {
        return 'employee';
    }

    public function getData()
    {
        return ['amount' => $this->amount];
    }
}
