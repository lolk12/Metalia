<?php
/**
 * Created by PhpStorm.
 * User: Алеша
 * Date: 17.05.2017
 * Time: 23:30
 */

namespace app\models;

use Yii;
use yii\base\Model;

class Signup extends Model
{
    public $username;
    public $email;
    public $password;
    public $full_name;
    public $email_confirmed;
    public $target;
    public $company_id;


    public function rules()
    {
        return [
            [['username',], 'trim'],
            [['username','full_name', 'password'], 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Пользователь с таким E-mail адресом уже существует'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 6],
            ['username', 'email'],
            ['email', 'email'],
            ['email_confirmed', 'number'],
        ];
    }

    public function attributeLabels() {
        return[
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Зарегестрирован'),
            'status' => Yii::t('app', 'Статус'),
            'username' => Yii::t('app', 'Почта'),
            'full_name' => Yii::t('app', 'Ф.И.О регистрирующего'),
            'password' => Yii::t('app', 'Пароль'),
        ];
    }

    public function signup($company_id)
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->username;
        $user->full_name = $this->full_name;
        $user->setPassword($this->password);
        $user->status = User::STATUS_WAIT;
        $user->email_confirmed = User::STATUS_WAIT;
        $user->company_id = $company_id;

        $user->generateAuthKey();
        $user->generateEmailConfirmToken();
        if ($user->save()) {
            Yii::$app->mailer->compose('@app/mail/emailConfirm', ['user' => $user])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($this->username)
                ->setSubject('Email confirmation for ' . Yii::$app->name)
                ->send();
            //$userRole = Yii::$app->authManager->getRole('user');
            //Yii::$app->authManager->assign($userRole, $user->getId());
            return $user;
        }

        return null;
    }

    public function getEmail(){
        return $this->username;
    }

}