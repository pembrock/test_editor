<?php

/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 19:12
 */

namespace Editor\Admin;

interface IPage
{
    public function getPage($id);

    public function searchPage($query);

    public function create($fields);

    public function update($fields);

    public function delete($id);

    public function pagesList();
}