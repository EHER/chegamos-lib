<?php

namespace chegamos\entity;

class User
{
    private $id = "";
    private $name = "";
    private $birthday = null;
    private $gender = null;
    private $photoUrl = null;
    private $photoMediumUrl = null;
    private $photoSmallUrl = null;
    private $stats = null;
    private $places = null;
    private $reviews = null;
    private $photos = null;
    private $lastVisit = null;

    public function getUserInfo()
    {
        $userInfo = array();
        if ($this->getGender()) {
            $userInfo[] = $this->getGender();
        }

        if ($this->getAge()) {
            $userInfo[] = $this->getAge();
        }

        return implode(", ", $userInfo);
    }

    public function getLastVisitInfo($returnLink = false)
    {
        $lastVisitInfo = '';

        if ($this->getLastVisit()->getName()) {
            $lastVisitInfo .= 'Último check-in: ';
            if ($returnLink) {
                $lastVisitInfo .= '<a href="';
                $lastVisitInfo .= $this->getLastVisit()->getPlaceUrl();
                $lastVisitInfo .= '">';
            }
            $lastVisitInfo .= $this->getLastVisit()->getName();
            $lastVisitInfo .= $returnLink ? '</a>' : '';

            return $lastVisitInfo;
        }

        return false;
    }

    public function setPlaces($places)
    {
        $this->places = $places;
    }

    public function getPlaces()
    {
        return $this->places;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFirstName()
    {
        $name = substr($this->name, 0, strpos($this->name, " "));

        return $name != "" ? $name : $this->name;
    }

    public function getAge()
    {
        if ($this->getBirthday()) {
            list($day, $month, $year) = explode("/", $this->getBirthday());

            $year = $year < 1900 ? $year + 1900 : $year;

            $year_diff = date("Y") - $year;
            $month_diff = date("m") - $month;
            $day_diff = date("d") - $day;
            if ($month_diff < 0) {
                $year_diff--;
            } elseif (($month_diff == 0) && ($day_diff < 0)) {
                $year_diff--;
            }

            return $year_diff.' anos';
        }

        return false;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getBirthday()
    {
        if ($this->birthday != null) {
            return date("d/m/y", strtotime($this->birthday));
        }

        return false;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getGender()
    {
        switch ($this->gender) {
        case 'M':
            return 'Masculino';
        case 'F':
            return 'Feminino';
        default:
            return false;
        }
    }

    public function setPhotoUrl($photoUrl)
    {
        $this->photoUrl = $photoUrl;
    }

    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }

    public function setPhotoSmallUrl($photoSmallUrl)
    {
        $this->photoSmallUrl = $photoSmallUrl;
    }

    public function getPhotoSmallUrl()
    {
        return $this->photoSmallUrl;
    }

    public function setPhotoMediumUrl($photoMediumUrl)
    {
        $this->photoMediumUrl = $photoMediumUrl;
    }

    public function getPhotoMediumUrl()
    {
        return $this->photoMediumUrl;
    }

    public function setStats($stats)
    {
        $this->stats = $stats;
    }

    public function getStats()
    {
        return $this->stats;
    }

    public function getLastVisit()
    {
        return $this->lastVisit;
    }

    public function setLastVisit($lastVisit)
    {
        $this->lastVisit = $lastVisit;
    }

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    public function getPhotos()
    {
        return $this->photos;
    }

    public function setPhotos($photos)
    {
        $this->photos = $photos;
    }

    public function getMainUrl()
    {
        if ($this->getId()) {
            return 'http://www.apontador.com.br/profile/'.$this->getId().'.html';
        }

        return false;
    }
}
