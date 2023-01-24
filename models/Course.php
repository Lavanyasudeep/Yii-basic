<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

use app\models\Course;

class Course extends ActiveRecord
{
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Course::find();

        $dataProvider = new ActiveDataProvider([
                'query'     =>  $query,
                'pagination'   => [
                    'pageSize'  =>  5,
                ],
                'sort'      =>  [
                    'defaultOrder'  => [
                        'id'    => SORT_DESC,
                    ]
                    ],
        ]);

        $this->load($params);

        if(!$this->validate())
        {
            return $dataProvider;
        }

        $query -> andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

}