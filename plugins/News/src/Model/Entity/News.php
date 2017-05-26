<?php
namespace News\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\Behavior\Translate\TranslateTrait;

/**
 * News Entity
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $is_feat
 * @property string $meta_keyword
 * @property string $meta_description
 * @property \Cake\I18n\Time $created
 * @property int $master_id
 *
 * @property \News\Model\Entity\Master $master
 */
class News extends Entity
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
	use TranslateTrait;
}
