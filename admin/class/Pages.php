<?php

/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 19:11
 */

namespace Editor\Admin;

use Editor\DB\DBConnect;
use PDO;
use DateTime;

class Pages implements IPage
{
    private $db;

    function __construct()
    {
        $this->db = DBConnect::instance()->getConnection();
    }

    public function getPage($id)
    {
        $query = "SELECT * FROM pages WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(array('id' => $id));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function searchPage($queryString)
    {
        $query = "SELECT * FROM pages WHERE title LIKE :query";
        $stmt = $this->db->prepare($query);
        $stmt->execute(array(':query' => "%" . $queryString . "%"));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function create($fields)
    {
        // TODO: Add fields validation
        $query = "INSERT INTO pages SET title = :title, header = :header, content = :content, additional_content = :additional_content, date_create = :date_create";
        $date = new DateTime();
        $execute = [
            'title' => $fields['title'],
            'header' => $fields['header'],
            'content' => $fields['content'],
            'additional_content' => $fields['additional_content'],
            'date_create' => $date->format('Y-m-d H:i:s')
        ];
        $stmt = $this->db->prepare($query);
        $stmt->execute($execute);
    }

    public function update($fields)
    {
        // TODO: Add fields validation
        if ($fields['id'] == 0) {
            $this->create($fields);
        } else {
            $query = "UPDATE pages SET title = :title, header = :header, content = :content, additional_content = :additional_content, date_edit = :date_edit WHERE id = :id";
            $date = new DateTime();
            $execute = [
                'id' => $fields['id'],
                'title' => $fields['title'],
                'header' => $fields['header'],
                'content' => $fields['content'],
                'additional_content' => $fields['additional_content'],
                'date_edit' => $date->format('Y-m-d H:i:s')
            ];
            $stmt = $this->db->prepare($query);
            $stmt->execute($execute);
        }
        return true;
    }

    public function delete($id)
    {
        $query = "DELETE FROM pages WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(array('id' => $id));

        return true;
    }

    /**
     * @return array
     */
    public function pagesList()
    {
        $query = "SELECT * FROM pages";

        $stmt = $this->db->prepare($query);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

}