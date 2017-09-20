<?php

namespace App\Models;

use Core\Model;
use PDO;

class Post extends Model
{
    /**
     * @return array
     */
    public static function getAll(): array
    {
        $db = static::getDB();

        $stmt = $db->query(
            "SELECT id, title, content FROM posts ORDER BY created_at"
        );

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}