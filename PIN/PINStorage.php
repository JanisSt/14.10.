<?php

class PINStorage
{
    private string $path;
    private array $pins = [];

    public function __construct(string $path)
    {

        $this->path = $path;
        $this->loadPINS();
    }

    public function searchPins()
    {
        if (isset($_POST['user'])) {
            foreach ($this->pins as $pin) {
                if ($pin->getUser() == $_POST['user'] &&
                    $pin->getPIN() == $_POST['pin']
                ) {
                    return $pin;
                }
            }
            return null;
        } return null;
    }

    public function loadPINS(): void
    {
        $file = fopen($this->path, 'rw+');
        while ($pin = fgetcsv($file)) {
            $this->pins[] = new PIN(
                (string)$pin[0],
                (string)$pin[1],

            );
        }
        fclose($file);
    }

    public function checkPIN($zip): ?PIN
    {
        foreach ($this->pins as $pin) {
            if ($pin->getPIN() == $zip) {
                return $pin;
            }
        }
        return null;
    }

}