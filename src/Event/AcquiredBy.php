<?php

namespace TestCode\Event;

use JMS\Serializer\Annotation as Serializer;

class AcquiredBy extends AbstractEvent
{

    protected $companyName;

    public function __construct(\DateTime $datetime, $address)
    {
        parent::__construct($datetime);
        $this->companyName = $address;
    }

    protected static function getType() : string
    {
        return 'acquired_by';
    }

    public function getData()
    {
        return [
            'companyName' => $this->companyName
        ];
    }


}
