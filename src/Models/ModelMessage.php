<?php
namespace Bizu\Weblistmc\Models;



class ModelMessage extends BaseModels {

    protected $id;
    protected $content;
    protected $authorId;
    protected $serverId;
    
    public function __construct()
    {
        $this->table = 'messages';
    }

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set the value of content
     */
    public function setContent($content): self {
        $this->content = $content;
        return $this;
    }

    /**
     * Get the value of authorId
     */
    public function getAuthorId() {
        return $this->authorId;
    }

    /**
     * Set the value of authorId
     */
    public function setAuthorId($authorId): self {
        $this->authorId = $authorId;
        return $this;
    }

    /**
     * Get the value of serverId
     */
    public function getServerId() {
        return $this->serverId;
    }

    /**
     * Set the value of serverId
     */
    public function setServerId($serverId): self {
        $this->serverId = $serverId;
        return $this;
    }
}