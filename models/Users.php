<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "id_user".
 *
 * @property int $id
 * @property string $profilname
 * @property string $username
 * @property string $password
 * @property string $last_login
 * @property string $authKey
 * @property string $accessToken
 * @property string $type
 * @property string $blocked
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'id_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profilname', 'username', 'password', 'last_login', 'authKey', 'accessToken', 'type', 'blocked'], 'required'],
            [['last_login'], 'safe'],
            [['profilname', 'username', 'password', 'authKey', 'accessToken', 'type', 'blocked'], 'string', 'max' => 100],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'profilname' => 'Profilname',
            'username' => 'Username',
            'password' => 'Password',
            'last_login' => 'Last Login',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'type' => 'Type',
            'blocked' => 'Blocked',
        ];
    }
}
