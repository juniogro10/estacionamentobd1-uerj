<?php

namespace common\components;

use yii\web\UrlRule;


/**
 * @author  Kravchuk Dmitry
 * @author  Dmitry Semenov <disemx@gmail.com>
 * Class PageUrlRule
 * @package yii2mod\cms\components
 */
class PageUrlRule extends UrlRule
{

    /**
     * @var string
     */
    public $pattern = '<\w+>';

    /**
     * @var string
     */
    public $connectionID = 'db';

    /**
     * @var string
     */
    public $route = 'site/page';

    /**
     * Parse request
     *
     * @param \yii\web\UrlManager $manager
     * @param \yii\web\Request $request
     *
     * @return boolean
     */
    public function parseRequest($manager, $request)
    {
        //echo 'aa';
        $pathInfo = $request->getPathInfo();
        //if (preg_match('%^app/dataset(?:/(?P<dataset_id>\d+)(?:/(?P<controller>report|dashboard|table)(?:/(?P<action>\w+)|/)?|/)?|/)?$%',$pathInfo,$matches)) {
        if (preg_match('%^app/dataset(?:/(?P<dataset_id>\d+)(?:/(?P<controller>report|dashboard|table)(?:/(?P<action>\w+)|/)?|/)|/)$%',$pathInfo,$matches)) {


            //var_dump($matches);
            //exit;
            if (isset($matches['action'])) {

                $params['dataset_id'] = $matches['dataset_id'];
                return ['app/'.$matches['controller'].'/'.$matches['action'], $params];


            } else if (isset($matches['controller'])) {

                $params['dataset_id'] = $matches['dataset_id'];
                return ['app/'.$matches['controller'].'/index', $params];


            } else if (isset($matches['dataset_id'])) {
                $params['dataset_id'] = $matches['dataset_id'];

                return ['app/dataset/index', $params];

            }



        }


        //var_dump($_SERVER);
        //var_dump($request);

		//exit;


        return parent::parseRequest($manager, $request);
    }

}
