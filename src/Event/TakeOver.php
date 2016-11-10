<?php

namespace TestCode\Event;

use JMS\Serializer\Annotation as Serializer;

class TakeOver extends AbstractEvent
{

    protected $companyName;

    public function __construct(\DateTime $datetime, string $address)
    {
        parent::__construct($datetime);
        $this->companyName = $address;
    }

    protected static function getType() : string
    {
        return 'take_over';
    }

    public function getData()
    {
        return [
            'companyName' => $this->companyName,
        ];
    }
}
