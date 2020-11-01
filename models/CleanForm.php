<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * CleanForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class CleanForm extends Model
{
    public $password;
    
    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password'], 'required'],
        ];
    }

    

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function clean()
    {
        return $this->password=="qqwweerrttyy";
    }


    /**
     * Returns the attribute labels.
     *
     * See Model class for more details
     *  
     * @return array attribute labels (name => label).
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Senha',
        ];
    }
}
