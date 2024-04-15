<?php

namespace Bizu\Weblistmc\Models;

class BaseModels extends DBConnection
{
    protected $table;

    private $db;

    public function findAll()
    {
        $query = $this->queryCustom('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    public function findBy(array $criteres)
    {
        $champs = [];
        $valeurs = [];

        foreach ($criteres as $champ => $valeur) {
            $champs[] = "$champ = ?";
            $valeurs[] = "$valeur";
        }

        $champs_query = implode(' AND ', $champs);

        return $this->queryCustom('SELECT * FROM '.$this->table.' WHERE '.$champs_query, $valeurs)->fetchAll();
    }

    public function findById(int $id)
    {
        return $this->queryCustom("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    public function create(BaseModels $models)
    {
        $champs = [];
        $inter = [];
        $valeurs = [];

        foreach ($models as $champ => $valeur) {
            if ($valeurs !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
        }



        $champs_list = implode(', ', $champs);
        $inter_list = implode(', ', $inter);

        return $this->queryCustom('INSERT INTO ' . $this->table . ' (' . $champs_list . ') VALUES(' . $inter_list . ')', $valeurs);
    }

    public function createWithArray(array $data)
    {
        foreach ($data as $key => $value) {

            $setter = 'set'.ucfirst($key);

            if(method_exists($this, $setter)){
                $this->$setter($value);
            }
        }

        return $this;
    }

    public function update(int $id, BaseModels $models)
    {
        $champs = [];
        $valeurs = [];

        foreach ($models as $champ => $valeur) {
            if ($valeurs !== null && $champ != 'db' && $champ != 'table') {
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }

        $valeurs[] = $id;

        $champs_list = implode(', ', $champs);

        return $this->queryCustom('UPDATE ' . $this->table . ' SET ' . $champs_list . ' WHERE id = ?', $valeurs);
    }


    public function delete(int $id)
    {
        return $this->queryCustom("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    protected function queryCustom(string $sql, array $attributs = null)
    {
        $this->db = DBConnection::getInstance();

        if ($attributs !== null) {
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            return $this->db->query($sql);
        }
    }
}
