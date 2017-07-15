<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_product".
 *
 * @property integer $pk_int_product_id
 * @property integer $fk_int_category_id
 * @property integer $fk_int_sub_category_id
 * @property string $vchr_item_name
 * @property string $text_description
 * @property string $vchr_product_image
 * @property integer $int_item_price
 *
 * @property TblOrderDetail[] $tblOrderDetails
 * @property TblCategory $fkIntCategory
 * @property TblSubCategory $fkIntSubCategory
 * @property TblProductSize[] $tblProductSizes
 */
class TblProduct extends \yii\db\ActiveRecord
{


    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_int_category_id', 'fk_int_sub_category_id', 'vchr_item_name', 'text_description', 'vchr_product_image', 'int_item_price'], 'required'],
            [['fk_int_category_id', 'fk_int_sub_category_id', 'int_item_price'], 'integer'],
            [['text_description'], 'string'],
            [['file'],'file'],
            [['vchr_item_name'], 'string', 'max' => 50],
            [['vchr_product_image'], 'string', 'max' => 255],
            [['fk_int_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblCategory::className(), 'targetAttribute' => ['fk_int_category_id' => 'pk_int_category_id']],
            [['fk_int_sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblSubCategory::className(), 'targetAttribute' => ['fk_int_sub_category_id' => 'pk_int_sub_category_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_int_product_id' => 'Pk Int Product ID',
            'fk_int_category_id' => 'Fk Int Category ID',
            'fk_int_sub_category_id' => 'Fk Int Sub Category ID',
            'vchr_item_name' => 'Vchr Item Name',
            'text_description' => 'Text Description',
            'vchr_product_image' => 'Vchr Product Image',
            'int_item_price' => 'Int Item Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblOrderDetails()
    {
        return $this->hasMany(TblOrderDetail::className(), ['fk_int_product_id' => 'pk_int_product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIntCategory()
    {
        return $this->hasOne(TblCategory::className(), ['pk_int_category_id' => 'fk_int_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIntSubCategory()
    {
        return $this->hasOne(TblSubCategory::className(), ['pk_int_sub_category_id' => 'fk_int_sub_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProductSizes()
    {
        return $this->hasMany(TblProductSize::className(), ['fk_int_product_id' => 'pk_int_product_id']);
    }
}
