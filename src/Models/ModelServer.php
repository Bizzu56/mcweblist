<?php

namespace Bizu\Weblistmc\Models;

class ModelServer extends BaseModels {

    protected $id;
    protected $server_ip;
    protected $name;
    protected $description;
    protected $userId;
    
    public function __construct()
    {
        $this->table = 'servers';
    }

    /**
     * Get the value of server_ip
     */ 
    public function getServer_ip()
    {
        return $this->server_ip;
    }

    /**
     * Set the value of server_ip
     *
     * @return  self
     */ 
    public function setServer_ip($server_ip)
    {
        $this->server_ip = $server_ip;

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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }


    /*          CUSTOM METHOD           */

    public function getServerMessagesEvents($id){
        return $this->queryCustom("SELECT JSON_OBJECT(
            'id', s.id,
            'ip', s.server_ip,
            'name', s.name,
            'description', s.description,
            'messages', COALESCE(JSON_ARRAYAGG(
                JSON_OBJECT(
                    'id', m.id,
                    'content', m.content,
                    'create_at', m.create_at,
                    'serverId', m.serverId,
                    'author', JSON_OBJECT(
                        'id', u.id,
                        'author', u.nickName
                    )
                )
            ), JSON_ARRAY())
        ) as servers
        FROM servers s
        LEFT JOIN messages m ON s.id = m.serverId
        LEFT JOIN users u ON m.authorId = u.id
        WHERE s.id = $id
        GROUP BY s.id, s.server_ip, s.name, s.description;
        ")->fetch();
    }
}