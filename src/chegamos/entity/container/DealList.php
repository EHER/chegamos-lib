<?php

namespace chegamos\entity\container;

class DealList extends ItemsList
{
    public function __construct($data = null)
    {
        if (!empty($data)) {
            foreach ($data->deals as $deal) {
                $this->add(new Deal($deal->deal));
            }
        }
    }
}
