<?php

class NumberStorage
{
    private string $path;
    private array $numbers = [];

    public function __construct(string $path)
    {

        $this->path = $path;
    }

    public function searchDatabase(): string
    {
        if (isset($_POST['search_number'])) {
            foreach ($this->numbers as $number) {
                if ($number->getPhoneNumber() == $_POST['search_number']
    )
                {
                    return $number->getNameSurname();
                }
            }
            return 'No such person found';
        }
        return '';
    }

    public function loadNumbers(): void
    {
        $file = fopen($this->path, 'rw+');
        while ($number = fgetcsv($file)) {
            $this->numbers[] = new Numbers(
                (string)$number[0],
                (string)$number[1],

            );
        }
        fclose($file);
    }

}