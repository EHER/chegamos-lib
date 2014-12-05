<?php

namespace chegamos\entity;


class Photo
{
    private $smallUrl = "";
    private $mediumUrl = "";
    private $largeUrl = "";
    private $created = null;
    private $author = null;

    public function getSmallUrl()
    {
        return $this->smallUrl;
    }

    public function setSmallUrl($smallUrl)
    {
        $this->smallUrl = $smallUrl;
    }

    public function getMediumUrl()
    {
        return $this->mediumUrl;
    }

    public function setMediumUrl($mediumUrl)
    {
        $this->mediumUrl = $mediumUrl;
    }

    public function getLargeUrl()
    {
        return $this->largeUrl;
    }

    public function setLargeUrl($largeUrl)
    {
        $this->largeUrl = $largeUrl;
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
