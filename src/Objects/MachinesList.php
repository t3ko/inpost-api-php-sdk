<?php

namespace T3ko\Paczkomaty\Objects;

class MachinesList
{
    private $machines;

    public function __construct(array $machines = [])
    {
        $this->machines = $machines;
    }

    function toArray()
    {
        return $this->machines;
    }

}
