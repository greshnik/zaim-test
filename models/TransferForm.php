<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Users;

class TransferForm extends \yii\base\Model
{
    public $userFrom;
    public $userTo;
    public $amount = 0;

    public function attributeLabels() {
    	return [
    		'amount' => 'Количество:',
    		'userFrom' => 'От кого:',
    		'userTo' => 'Кому:'
    	];
    }

    public function rules()
    {
        return [
            [['userFrom', 'userTo', 'amount'], 'required'],
            ['amount', 'validateAmount'],
            ['userFrom', function($attribute, $params) {
            	if($this->userFrom === $this->userTo) {
            		$this->addError($attribute, 'Нельзя переводить самому себе!');
            	}
    		}]
        ];
    }

    public function validateAmount($attribute, $params) {
    	if(!Users::enoughBalance($this->userFrom, $this->$attribute)) {
    		$this->addError($attribute, 'У вас не хватает денег!');
    	}
    	if($this->$attribute <= 0) {
    		$this->addError($attribute, 'Нельзя отправлять такую сумму!');
    	}
    }
}