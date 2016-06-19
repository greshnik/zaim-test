<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 * @property string $balance
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'balance'], 'required'],
            [['balance'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'balance' => 'Баланс',
        ];
    }

    public function transferMoney($userId, $amount) {
        $user = self::findOne($userId);
        $tempBalance = $this->balance;
        $user->balance = bcadd($user->balance, $amount, 2);
        $this->balance = bcsub($this->balance, $amount, 2);
        if($this->balance > 0 && $user->save() && $this->save()) {
            return $user;
        }
        $this->balance = $tempBalance;
        return false;
    }

    public static function getUsersIdName() {
        $users = self::find()->all();
        $result = [];
        foreach ($users as $key => $user) {
            $result[$user->id] = $user->name.' ('.$user->balance.')';
        }
        return $result;
    }

    public static function enoughBalance($userId, $amount) {
        $user = self::findOne($userId);
        if($user->balance >= $amount) {
            return true;
        }
        return false;
    }
}
