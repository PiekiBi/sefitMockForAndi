<?php

class Aspect
{
    public string $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

class ExampleObject
{
    public string $userName;
    public string $description;
    public array $aspects;
    public bool $isRequest;

    public function __construct(
        $userName,
        $description,
        $aspects,
        $isRequest,
    )
    {
        $this->userName = $userName;
        $this->description = $description;
        $this->aspects = $aspects;
        $this->isRequest = $isRequest;
    }
}
