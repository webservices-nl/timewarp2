<?php

namespace TestCode\Event;

use JMS\Serializer\Annotation as Serializer;

class LegalForm extends AbstractEvent
{

    protected $legalForm;

    public function __construct(\DateTime $datetime, string $amount)
    {
        parent::__construct($datetime);
        $this->legalForm = $amount;
    }

    protected static function getType() : string
    {
        return 'legalForm';
    }

    public function getData()
    {
        return ['legal_form' => $this->legalForm];
    }
}
