<?php
namespace CityManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * LanPageCity Entity
 *
 * @property int $id
 * @property int $city_id
 * @property string $image
 * @property string $is_feat
 *
 * @property \CityManager\Model\Entity\City $city
 */
class LanPageCity extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
