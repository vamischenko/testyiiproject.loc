<?php

namespace common\models;

use common\helpers\Dictionary;
use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Company
 *
 * @property int $id
 * @property string $name
 * @property integer $status
 * @property boolean $isActive
 */
class Company extends ActiveRecord
{
    const STATUS_DELETED = -1;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'filter', 'filter' => function($value) {
                return preg_replace('/\s+/u', ' ', trim($value));
            }],
            [['name'], 'unique'],
            [['name'], 'string', 'max' => 255],
            ['active', 'integer'],
        ];
    }

    public static function status()
    {
        return [
            self::STATUS_ACTIVE => 'Активный',
            self::STATUS_INACTIVE => 'Неактивный',
            self::STATUS_DELETED => 'Удален'
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'active' => 'Действующая компания',
        ];
    }

    /**
     * @param $includeId
     * @return array
     */
    public static function listing($includeId)
    {
        return self::find()
            ->select(['name', 'id'])
            ->andFilterWhere(['or',
                ['status' => Dictionary::STATUS_ACTIVE],
                ['id' => $includeId],
            ])
            ->orderBy('name')
            ->indexBy('id')
            ->column();
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return $this->status == Dictionary::STATUS_ACTIVE;
    }

}