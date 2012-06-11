<?php

namespace chegamos\entity\factory;

use chegamos\entity\Point;

class PointFactory
{
    public static function generate(\stdClass $data)
    {
        return new Point($data->lat, $data->lng);
    }
}
