<?php

namespace TestCode;

use EventStore\WritableEventCollection;

class CompanyHistory
{

    protected $company;

    /**
     * @var WritableEventCollection
     */
    protected $events;

    public function __construct($company, array $events = [])
    {
        $this->company = $company;
        $this->initializeHistory($events);
    }

    protected function initializeHistory(array $events)
    {
//        var_dump($events);die;
        $this->events = new WritableEventCollection($events);
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return WritableEventCollection
     */
    public function getEvents(): WritableEventCollection
    {
        return $this->events;
    }

    public function setEvents(array $events)
    {
        $this->initializeHistory($events);
    }

}