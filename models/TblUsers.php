<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_customers".
 *
 * @property integer $pk_int_customer_id
 * @property string $vchr_name
 * @property string $vchr_gender
 * @property string $vchr_mobile
 * @property string $vchr_email
 * @property string $vchr_password
 * @property string $text_address
 *
 * @property TblOrder[] $tblOrders
 */
class TblUsers extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vchr_name', 'vchr_gender', 'vchr_mobile', 'vchr_email', 'vchr_password', 'text_address'], 'required'],
            [['text_address'], 'string'],
            [['vchr_name'], 'string', 'max' => 50],
            [['vchr_gender', 'vchr_mobile'], 'string', 'max' => 12],
            [['vchr_email', 'vchr_password'], 'string', 'max' => 255],
            [['vchr_email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_int_user_id' => 'User ID',
            'vchr_name' => 'Name',
            'vchr_gender' => 'Gender',
            'vchr_mobile' => 'Mobile',
            'vchr_email' => 'Email',
            'vchr_password' => 'Password',
            'text_address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblOrders()
    {
        return $this->hasMany(TblOrder::className(), ['fk_int_user_id' => 'pk_int_user_id']);
    }
    public function getAuthKey() {
       
    }

    public function getId() {
         return $this->getPrimaryKey();
    }

    public function validateAuthKey($authKey){
        
        
        
    }

    public static function findIdentity($id){
        
        return self::findOne($id);
        
    }

    public static function findIdentityByAccessToken($token, $type = null){
        return self::findOne(['access_token'=>$token]);
    }
    public static function findByUsername($email){
        return self::findOne(['vchr_email'=>$email]);
    }

    public function validatePassword($password){
        
        
        return $this->vchr_password;// === sha1($password);
    }
}
