<?php

namespace Bizu\Weblistmc\Models;

class ModelExemple extends BaseModels
{
    protected $title;
    protected $isActive;

    public function __construct()
    {
        $this->table = 'exemple';
    }


    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of isActive
     */ 
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set the value of isActive
     *
     * @return  self
     */ 
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }



    public function test(){
        return $this->queryCustom("SELECT JSON_OBJECT(
            'id', s.id,
            'ip', s.server_ip,
            'name', s.name,
            'description', s.description,
            'messages', JSON_ARRAYAGG(
                JSON_OBJECT(
                    'id', m.id,
                    'content', m.content,
                    'create_at', m.create_at,
                    'author', JSON_OBJECT(
                        'id', u.id,
                        'author', u.nickName
                    )
                )
            ),
            'events', (
                SELECT JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'id', e.id,
                        'start_at', e.event_start_at,
                        'title', e.title,
                        'description', e.description
                    )
                )
                FROM events e WHERE e.serverId = s.id
            )
        ) as server_infos
        FROM servers AS s
        LEFT JOIN messages m ON s.id = m.serverId
        LEFT JOIN users u ON m.authorId = u.id
        WHERE s.id = 1;")->fetch();
    }
}
