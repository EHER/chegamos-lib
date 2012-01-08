<?php

namespace chegamos\entity\container;

use chegamos\entity\Review;

class ReviewList extends ItemsList
{
    public function __construct($data = null)
    {
        if (is_object($data)) {
            $this->setNumFound($data->result_count);
            $this->setCurrentPage($data->current_page);
            foreach ($data->reviews as $place) {
                $this->add(new Review($place->review));
            }
        }
    }
}
