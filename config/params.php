<?php

return [
	//Yii::setAlias('@articuloImgPath','C:\xampp\htdocs\SGP-EA\web\files'),
	Yii::setAlias('@articuloImgPath',__DIR__.'\..\web\files'),
	Yii::setAlias('@articuloImgUrl','http://localhost/SGP-EA/web/files'),
	Yii::setAlias('@vistas','C:\xampp\htdocs\SGP-EA\views'),
    'adminEmail' => 'admin@example.com',
    'mdm.admin.configs' => [
    'defaultUserStatus' => 0, // 0 = inactive, 10 = active
    	]
];
