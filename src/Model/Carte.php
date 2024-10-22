<?php

declare(strict_types=1);

namespace App\Model;

class Carte extends Model
{
    use TraitInstance;

    protected $tableName = APP_TABLE_PREFIX . 'carte';

    // public function findAllWithDecks(): array
    // {
    //     $sql = "
    //         SELECT *
    //         FROM " . APP_TABLE_PREFIX . "deck AS deck
    //         LEFT JOIN {$this->tableName} AS carte ON carte.id_deck = deck.id_deck
    //     ";
    
    //     $sth = $this->query($sql);
    //     return $sth->fetchAll();
    // }
    public function findAllWithDecksCreateur(): array
    {
        $sql = "
            SELECT deck.*, COUNT(carte.id_carte) AS carte_count
            FROM " . APP_TABLE_PREFIX . "deck AS deck
            LEFT JOIN {$this->tableName} AS carte ON carte.id_deck = deck.id_deck
            GROUP BY deck.id_deck
            HAVING carte_count > 0
        ";
    
        $sth = $this->query($sql);
        return $sth->fetchAll();
    }
    public function findAllWithDecksAdmin(): array
    {
        $sql = "
            SELECT deck.*, COUNT(carte.id_carte) AS carte_count
            FROM " . APP_TABLE_PREFIX . "deck AS deck
            LEFT JOIN {$this->tableName} AS carte ON carte.id_deck = deck.id_deck
            GROUP BY deck.id_deck
        ";
    
        $sth = $this->query($sql);
        return $sth->fetchAll();
    }
    
    public function findByDeckAndCreateur(int $id_deck, int $id_createur): ?array
    {
        return $this->findAllBy(['id_deck' => $id_deck, 'id_createur' => $id_createur]);
    }        
    public function countByDeckId(int $id_deck): int
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->tableName} WHERE id_deck = :id_deck";
        $sth = $this->query($sql, [':id_deck' => $id_deck]);
        $result = $sth->fetch();
        return $result ? (int) $result['total'] : 0;
    }
    
}
