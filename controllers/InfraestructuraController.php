<?php
namespace app\controllers;

use app\models\Infraestructura;


class InfraestructuraController extends PrestamoController
{
    /**
     * @inheritdoc
     */

    public function actionIndex()
    {
    	$model = new Infraestructura();

        return $this->render('index', ['model' => $model]);
    }
}
