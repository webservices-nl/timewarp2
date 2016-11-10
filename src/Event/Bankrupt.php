<?php

namespace TestCode\Event;

use JMS\Serializer\Annotation as Serializer;

class Bankrupt extends AbstractEvent
{

    public function __construct(\DateTime $datetime)
    {
        parent::__construct($datetime);
    }

    protected static function getType() : string
    {
        return 'bankrupt';
    }

    public function getData()
    {
        return [
        ];
    }
}
