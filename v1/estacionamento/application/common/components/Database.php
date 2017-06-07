<?php
/**
 * Created by PhpStorm.
 * User: Mauricio Vicente de Lima Junior
 * Company : BlueBi
 * Date: 20/05/2017
 * Time: 20:20
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\web\UrlRule;

class Database extends Component
{
//    Consulta somente
    public function query_all($query)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($query);
        $result = $command->queryAll();
        return $result;
    }

//  Usada para insert ou update
    public function query_execute($query)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($query);

        $result = $command->execute();
        return $result;
    }
}