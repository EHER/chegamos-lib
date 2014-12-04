<?php

namespace chegamos\entity\factory;

use chegamos\entity\GasStationItem;
use chegamos\exception\ChegamosException;

class GasStationItemFactory
{
    private static $gasStationData = array(
        'alcohol' => 'Álcool',
        'biodiesel' => 'Biodiesel',
        'gasoline' => 'Gasolina',
        'gasoline_aditivada' => 'Gasolina Aditivada',
        'gasoline_podium' => 'Gasolina Pódium',
        'gasoline_premium' => 'Gasolina Premium',
        'gnv' => 'Gás Natural',
        'kerosene' => 'Querosene',
        'diesel' => 'Diesel',
        'diesel_aditivado' => 'Diesel Aditivado',
    );

    public static function generate($itemName, $data = null)
    {
        $gasStationItem = new GasStationItem();

        $itemName = self::sanitizeItemName($itemName);

        $label = self::sanitizeLabel($itemName, $data);
        $value = self::sanitizeValue($itemName, $data);
        $averageValue = self::sanitizeAverageValue($itemName, $data);
        $collectDate = self::sanitizeCollectDate($itemName, $data);

        $gasStationItem->setLabel($label);
        $gasStationItem->setValue($value);
        $gasStationItem->setAverageValue($averageValue);
        $gasStationItem->setCollectDate($collectDate);

        return $gasStationItem;
    }

    private static function getGasStationData()
    {
        return self::$gasStationData;
    }

    public static function sanitizeItemName($itemName)
    {
        return str_replace('price_', '', $itemName);
    }

    public static function sanitizeLabel($itemName, $data)
    {
        $data = self::getGasStationData();
        if (isset($data[$itemName])) {
            return $data[$itemName];
        }
        throw new ChegamosException("Invalid item name");
    }

    public static function sanitizeValue($itemName, $data)
    {
        if (isset($data->{"price_".$itemName})) {
            return $data->{"price_".$itemName};
        }
        throw new ChegamosException("Invalid item name");
    }

    public static function sanitizeAverageValue($itemName, $data)
    {
        if (isset($data->{"average_".$itemName})) {
            return $data->{"average_".$itemName};
        }
        throw new ChegamosException("Invalid item name");
    }

    public static function sanitizeCollectDate($itemName, $data)
    {
        if (isset($data->{"collect_date_".$itemName})) {
            return date("d/m H:i", strtotime($data->{"collect_date_".$itemName}));
        }
        throw new ChegamosException("Invalid item name");
    }
}
