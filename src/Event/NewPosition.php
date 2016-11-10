<?php

namespace TestCode\Event;

use JMS\Serializer\Annotation as Serializer;

class NewPosition extends AbstractEvent
{

    protected $position;

    protected $personName;

    protected $previousPersonName;

    public function __construct(\DateTime $datetime, string $personName, string $position, $previousPersonName = null)
    {
        parent::__construct($datetime);
        $this->position = $position;
        $this->personName = $personName;
        $this->previousPersonName = $previousPersonName;
    }

    protected static function getType() : string
    {
        return 'new_position';
    }

    public function getData()
    {
        $result = [
            'person' => $this->personName,
            'position' => $this->position,
        ];

        if ($this->previousPersonName !== null) {
            $result['previous_person'] = $this->previousPersonName;
        }

        return $result;
    }
}
