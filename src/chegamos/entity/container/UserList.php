<?php

namespace chegamos\entity\container;

class UserList extends ItemsList
{
    public function __construct($data)
    {
        $this->populate($data);
    }

    public function populate($data)
    {
        if (isset($data->result_count)) {
            $this->setNumFound($data->result_count);
        }
        if (isset($data->current_page)) {
            $this->setCurrentPage($data->current_page);
        }
        if (isset($data->users)) {
            foreach ($data->users as $user) {
                $this->add(new User($user->user));
            }
        }
    }
}
