<?php

namespace TestCode\Event;

use JMS\Serializer\Annotation as Serializer;

class Relocation extends AbstractEvent
{

    protected $address;

    protected $squareMeters;

    public function __construct(\DateTime $datetime, string $address, $squareMeters)
    {
        parent::__construct($datetime);
        $this->squareMeters = $squareMeters;
        $this->address = $address;
    }

    protected static function getType() : string
    {
        return 'relocation';
    }

    public function getData()
    {
        return [
            'address' => $this->address,
            'squareMeters' => $this->squareMeters,
        ];
    }
}
