<?php

namespace Bizu\Weblistmc\Models;


class ModelUser extends BaseModels
{

    protected $id;
    protected $email;
    protected $password;
    protected $nickName;
    protected $isBanned;
    protected $isAdmin;

    public function __construct()
    {
        $this->table = 'users';
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of isBanned
     */
    public function getIsBanned()
    {
        return $this->isBanned;
    }

    /**
     * Set the value of isBanned
     *
     * @return  self
     */
    public function setIsBanned($isBanned)
    {
        $this->isBanned = $isBanned;

        return $this;
    }

    /**
     * Get the value of nickName
     */
    public function getNickName()
    {
        return $this->nickName;
    }

    /**
     * Set the value of nickName
     *
     * @return  self
     */
    public function setNickName($nickName)
    {
        $this->nickName = $nickName;

        return $this;
    }

    /**
     * Get the value of isAdmin
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @return  self
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }


    /*          CUSTOM METHOD           */

    public function ifExistingUser($email)
    {
        $userData = $this->queryCustom("SELECT * FROM users WHERE email = ?", [$email])->fetch();

        if ($userData) {
            return $userData;
        }
        return false;
    }


    public function getAllUserForAdmin(){
        return $this->queryCustom("SELECT id, nickName, email FROM users")->fetchAll();
    }
}
