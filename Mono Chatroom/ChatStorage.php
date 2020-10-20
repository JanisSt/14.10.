<?php

class ChatStorage
{
    private string $path;
    private array $chat = [];

    public function __construct(string $path)
    {
        $this->path = $path;
        $this->getChat();
    }

    private function getChat(): void
    {
        $csv = fopen($this->path, 'r');
        while (($task = fgetcsv($csv)) == true) {
            $this->chat[] = new Chat($task[0], $task[1]);
        }
        fclose($csv);
    }


    public function addLine(Chat $chat): void
    {
        $this->chat[] = $chat;
        $this->toCSV();
    }

    public function getLine(): array
    {
        if (isset($this->chat)) {
            return $this->chat;
        }

    }

    public function toCSV(): void
    {
        $data = fopen($this->path, 'w');
        if (isset($this->chat)) {
            foreach ($this->chat as $lines) {
                fputcsv($data, [$lines->getUser(), $lines->getMessage()]);

            }
        }
    }
}