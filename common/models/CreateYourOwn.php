<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "create_your_own".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $session_id
 * @property integer $gender
 * @property integer $character_id
 * @property integer $scent
 * @property string $note
 * @property integer $bottle
 * @property string $label_1
 * @property string $label_2
 * @property string $tot_amount
 * @property integer $status
 */
class CreateYourOwn extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'create_your_own';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'gender', 'character_id', 'scent', 'bottle', 'status'], 'integer'],
            [['tot_amount'], 'number'],
            [['session_id', 'note', 'label_1', 'label_2'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'session_id' => 'Session ID',
            'gender' => 'Gender',
            'character_id' => 'Character',
            'scent' => 'Scent',
            'note' => 'Note',
            'bottle' => 'Bottle',
            'label_1' => 'Label 1',
            'label_2' => 'Label 2',
            'tot_amount' => 'Tot Amount',
            'status' => 'Status',
        ];
    }

}
