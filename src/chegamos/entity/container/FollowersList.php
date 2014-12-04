<?php

namespace chegamos\entity\container;

class FollowersList extends ItemsList
{
    public $userId = '';
    public $currentPage = 0;

    public function __construct($data = null)
    {
        if (!empty($data)) {
            $this->setNumFound($data->result_count);
            $this->setCurrentPage($data->current_page);
            $this->setUserId($data->id);
            foreach ($data->users as $user) {
                $this->add(new User($user->user));
            }
        }
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }
}
