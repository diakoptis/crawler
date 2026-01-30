<?php

class Database
{
    private PDO $pdo;

    public function __construct(string $path)
    {
        $this->pdo = new PDO('sqlite:' . $path);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->init();
    }

    private function init(): void
    {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS products (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                url TEXT,
                title TEXT,
                price TEXT,
                availability TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");
    }

    public function save(string $url, array $data): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO products (url, title, price, availability)
            VALUES (:url, :title, :price, :availability)
        ");

        $stmt->execute([
            ':url' => $url,
            ':title' => $data['title'],
            ':price' => $data['price'],
            ':availability' => $data['availability'],
        ]);
    }
}
