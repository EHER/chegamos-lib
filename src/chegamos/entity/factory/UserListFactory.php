<?php

namespace chegamos\entity\factory;

use chegamos\exception\ChegamosException;
use chegamos\entity\container\UserList;

class UserListFactory
{
    public static function generate($userListJsonObject)
    {
        if (is_object($userListJsonObject)) {
            $userList = new UserList();
            $userList->setNumFound($userListJsonObject->result_count);
            $userList->setCurrentPage($userListJsonObject->current_page);
            foreach ($userListJsonObject->users as $user) {
                $userList->add(UserFactory::generate($user->user));
            }
            return $userList;
        } else {
            throw new ChegamosException("Parâmetro passado não é um objeto.");
        }
    }
}
