<?php

class HomeModel extends Model
{
    public function getData()
    {
        $query = 'SELECT message FROM messages WHERE id = 1';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
}