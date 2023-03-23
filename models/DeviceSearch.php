<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Device;

/**
 * DeviceSearch represents the model behind the search form of `app\models\Device`.
 */
class DeviceSearch extends Device
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company', 'location', 'port', 'status'], 'integer'],
            [['uuid', 'name', 'ip', 'version', 'osVersion', 'platform', 'fmVersion', 'serialNumber', 'deviceModel', 'lastConnectedAt', 'createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Device::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'company' => $this->company,
            'location' => $this->location,
            'port' => $this->port,
            'status' => $this->status,
            'lastConnectedAt' => $this->lastConnectedAt,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'version', $this->version])
            ->andFilterWhere(['like', 'osVersion', $this->osVersion])
            ->andFilterWhere(['like', 'platform', $this->platform])
            ->andFilterWhere(['like', 'fmVersion', $this->fmVersion])
            ->andFilterWhere(['like', 'serialNumber', $this->serialNumber])
            ->andFilterWhere(['like', 'deviceModel', $this->deviceModel]);

        return $dataProvider;
    }
}
