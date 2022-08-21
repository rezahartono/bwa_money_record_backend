<?php

class User
{
    public static function setUser($data)
    {
        $result = array(
            'id' => $data['id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        );

        return $result;
    }
}
