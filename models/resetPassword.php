<?php
/**
 * Created by PhpStorm.
 * User: Esfero
 * Date: 01.03.2019
 * Time: 19:21
 */

namespace app\models;

use Yii;
use yii\base\Model;

use yii\helpers\Html;

class resetPassword extends Model
{
    public $email;
    public $captcha;

    public function rules()
    {
        return [
            [['email', 'captcha'], 'required'],
            ['email', 'email'],
            ['captcha', 'captcha']
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'captcha' => 'Введіть код на зображенні'
        ];
    }

    public function resetPassword()
    {
        if ($this->validate()) {
            $this->email = 'brooki.esf@gmail.com';
            $user = Userdb::findOne(['email' => $this->email]);
            if (!empty($user->email)) {
                // $link = Html::a('visit this page', [Yii::$app->params['BaseUrl'].'/site/reset-password', 'token'=>$user->password_reset_token]);
                Yii::$app->mailer->compose()->
                setTo($this->email)->
                setFrom(Yii::$app->params['adminEmail'])->
                setSubject('reset password')->
                setHtmlBody('<a href="http://web6yii.com/site/reset-password&token=' . $user->password_reset_token . '">visit</a>')
                    ->send();
                return true;
            } else {
                return false;
            }

        }
    }
}