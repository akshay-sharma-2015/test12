<?php
namespace CityManager\Model\Entity;

use Cake\ORM\Entity;

/**
 * CityDetail Entity.
 *
 * @property int $id
 * @property int $city_id
 * @property \CityManager\Model\Entity\City $city
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int $object_id
 * @property \CityManager\Model\Entity\Object $object
 * @property \Cake\I18n\Time $created
 */
class CityDetail extends Entity
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
        'id' => false,
    ];
}
