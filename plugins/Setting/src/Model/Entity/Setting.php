<?php
namespace Setting\Model\Entity;

use Cake\ORM\Entity;

/**
 * Setting Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $key_name
 * @property string $value
 * @property string $tag_type
 * @property bool $is_active
 * @property int $order_by
 * @property \Cake\I18n\Time $created
 */
class Setting extends Entity
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
