<?php

namespace app\models;
use mdm\admin\models\User as UserModel;

class User extends UserModel
{
    public $password;
    public $confirm_password;
 
    /**
     * @var \common\models\User
     */
    private $_user;

    public function rules()
    {
		return [
            ['id', 'integer'],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [['password','confirm_password'], 'required'],
            [['password','confirm_password'], 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message'=>'Las contraseñas introducidas deben ser iguales'],
		];
    }

	public function attributeLabels()
    {
		return [
			'username'=>'Nombre de usuario',
            'password' => 'Contraseña nueva',
            'confirm_password' => 'Confirmar contraseña'
		];
    }
    public function changePassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
 
        return $user->save(false);
    }

}
