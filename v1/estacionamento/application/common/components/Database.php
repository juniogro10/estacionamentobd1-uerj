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
    public static function query_all($query)
    {
        $connection = Yii::$app->getDb();

        $command = $connection->createCommand($query);
        $result = $command->queryAll();
        return $result;
    }

//  Usada para insert ou update
    public static function query_execute($query)
    {


        $connection = Yii::$app->getDb();

        $command = $connection->createCommand($query);

        try{
            $result = $command->execute();
            return $result;

        }catch (\Exception $e)
        {
            var_dump('erro na query execute');
            throw new \Exception($e->getMessage());
            return false;
        }

    }
}