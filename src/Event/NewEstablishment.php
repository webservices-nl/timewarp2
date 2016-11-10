<?php

namespace TestCode\Event;

use JMS\Serializer\Annotation as Serializer;

class NewEstablishment extends AbstractEvent
{

    protected $activity;

    protected $companyName;

    public function __construct(\DateTime $datetime, $personName, $position)
    {
        parent::__construct($datetime);
        $this->activity = $position;
        $this->companyName = $personName;
    }

    protected static function getType() : string
    {
        return 'new_establishment';
    }

    public function getData()
    {
        return [
            'company_name' => $this->companyName,
            'activity' => $this->activity,
        ];
    }
}
