<?php

namespace chegamos\entity;

class Review
{
    private $id = "";
    private $place = null;
    private $rating = 0;
    private $content = "";
    private $created = null;
    private $author = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace($place)
    {
        $this->place = $place;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }
}
