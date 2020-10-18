<?php

class Numbers
{
    private string $phoneNumber;
    private string $NameSurname;

    public function __construct(string $NameSurname, string $phoneNumber)
    {

        $this->phoneNumber = $phoneNumber;
        $this->NameSurname = $NameSurname;
    }

    public function getPhoneNumber():string
    {
        return $this->phoneNumber;
    }
    public function getNameSurname():string
    {
        return $this->NameSurname;
    }

    public function getUser():string
    {
        return $this->getNameSurname() . $this->getPhoneNumber();
    }


}