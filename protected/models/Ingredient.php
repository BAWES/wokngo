<?php

/**
 * This is the model class for table "ingredient".
 *
 * The followings are the available columns in table 'ingredient':
 * @property integer $ingredient_id
 * @property string $ingredient_name
 * @property string $ingredient_match_name
 * @property string $ingredient_image
 */
class Ingredient extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ingredient';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ingredient_name, ingredient_match_name', 'required'),
            array('ingredient_name, ingredient_match_name', 'length', 'max' => 120),
            
            array('ingredient_image', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => false, 'on' => 'create'),
            array('ingredient_image', 'file', 'types' => 'jpg, gif, png, jpeg', 'allowEmpty' => true, 'on' => 'update'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ingredient_id, ingredient_name, ingredient_match_name, ingredient_image', 'safe', 'on' => 'search'),
        );
    }

    //return logo image url
    public function getImage() {
        return Yii::app()->request->baseUrl . "/images/ingredients/" . $this->ingredient_image;
    }
    
    //Delete the image file before deleting the record
    protected function beforeDelete() {
        if (parent::beforeDelete()) {
            $image = $this->ingredient_image;
            if (!empty($image)) {
                $image = Yii::app()->basePath . "/../images/ingredients/" . $image;

                if (file_exists($image)){
                    unlink($image);
                }
            }

            return true;
        }
        else
            return false;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ingredient_id' => 'Ingredient',
            'ingredient_name' => 'Ingredient Name',
            'ingredient_match_name' => 'Ingredient Match Name',
            'ingredient_image' => 'Ingredient Image',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ingredient_id', $this->ingredient_id);
        $criteria->compare('ingredient_name', $this->ingredient_name, true);
        $criteria->compare('ingredient_match_name', $this->ingredient_match_name, true);
        $criteria->compare('ingredient_image', $this->ingredient_image, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ingredient the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
