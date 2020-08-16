<?php

declare(strict_types=1);

namespace Dice\Test;

use PDO;

final class DicePdoDriver
{
    public function __construct(string $dsn)
    {

        $this->pdo = new PDO($dsn);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("set time_zone = '+00:00'");
    }
}
