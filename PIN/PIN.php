<?php

class PIN
{



    private string $user;
    private string $PIN;

    public function __construct(string $user, string $PIN)
    {

        $this->PIN = $PIN;
        $this->user = $user;
    }

    public function getPIN(): string
    {
        return $this->PIN;
    }

    public function getUser(): string
    {
        return $this->user;
    }



}
