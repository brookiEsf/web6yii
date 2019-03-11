<?php
/**
 * Created by PhpStorm.
 * User: Esfero
 * Date: 04.03.2019
 * Time: 7:47
 */

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\SignUp;
use app\models\Userdb;

class newPasswordEnter extends Model
{
    public $password;
    public $confirmPassword;
    public $passwordResetToken;

    public function rules()
    {
        return [
            [['password', 'confirmPassword'], 'required'],
            ['password', 'validatePasswordAndPasswordConfirm'],
            ['confirmPassword', 'validatePasswordAndPasswordConfirm']
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Введіть новий пароль',
            'confirmPassword' => 'Повторіть пароль'
        ];
    }

    public function newPasswordEnter()
    {
        $status = $this->validate();
        if (empty($password)) {
            $this->addError('password', 'you didn`t type any password!');
            return false;
        }
        if (empty($confirmPassword)) {
            $this->addError('confirmPassword', 'you didn`t confirm your password!');
            return false;
        } else if ($status === true) {
            $user = new Userdb();
            $user->setAttributes([
                'password' => $this->password,
                'updated_at' => date('Y-m-d h:i:s'),
                'password_reset_token' => SignUp::createPasswordResetToken(),
            ], true);
            if ($user->save()) {
                return true;
            } else {
                return false;
            }


        }
    }
}