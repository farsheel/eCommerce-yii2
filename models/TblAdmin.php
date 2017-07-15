<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_admin".
 *
 * @property integer $pk_int_admin_id
 * @property string $vchr_admin_email
 * @property string $vchr_password
 */
class TblAdmin extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vchr_admin_email', 'vchr_password'], 'required'],
            [['vchr_admin_email', 'vchr_password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_int_admin_id' => 'Pk Int Admin ID',
            'vchr_admin_email' => 'Vchr Admin Email',
            'vchr_password' => 'Vchr Password',
        ];
    }
}
