<?php

class Chat
{
    private string $user;
    private string $message;

    public function __construct(string $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;

    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getUser(): string
    {
        return $this->user;
    }


}