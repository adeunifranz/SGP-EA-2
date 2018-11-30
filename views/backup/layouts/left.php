<?php 
use yii\helpers\Html;
 ?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="img/boy-512.png" class="img-circle" alt="User Image" background-color="white"/>
            </div>
            <div class="pull-left info">
               <?php echo 
                !Yii::$app->user->isGuest ? (
                    '<p>'.Yii::$app->user->identity->username
                        .'<small> <i class="fa fa-toggle-on text-success"> Conectado</i></small></p>'.
                         Html::a('
                        <span class="label label-success">Cerrar sesion </i></span>',['site/logout'],['class'=>'dropdown-toggle']))
                          : (
                    Html::a(
                    '<p>'.''
                        .' <i class="fa fa-toggle-off text-warning"> Desconectado</i></p>'.
                         Html::a('
                        <span class="label label-default">Iniciar sesion </span>',['site/login'],['class'=>'dropdown-toggle']))
)
                ?></a>
            </div>
        </div>
        <!-- search form -->
        <?php 
        // echo
        // '<form action="#" method="get" class="sidebar-form">
        //             <div class="input-group">
        //                 <input type="text" name="q" class="form-control" placeholder="Search..."/>
        //               <span class="input-group-btn">
        //                 <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
        //                 </button>
        //               </span>
        //             </div>
        //         </form>'

         ?>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Iniciar sesion', 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Registrarse', 'url' => ['/site/signup']],
                    ['label' => 'Admin', 'icon' => 'user-plus', 'url' => ['/admin'],],
                    ['label' => 'Persona', 'icon' => 'address-book-o', 'url' => ['/persona'],],
                    ['label' => 'Articulo', 'icon' => 'cubes', 'url' => ['/articulo'],],
                    ['label' => 'Computadora', 'icon' => 'television', 'url' => ['/computadora'],],
                    ['label' => 'Prestamo', 'icon' => 'money', 'url' => ['/prestamo'],],
                    ['label' => \Yii::t('app','Idioma'),
                        'items' => [
                            ['label' => Html::img('@web/img/es.png',['alt'=>'Español']).
                                '  '.Yii::t('app','Español'),
                                'url' => ['/site/langes'],
                                'language'=> ['es'],
                                'encode'=>false], //necesario para poder agregar imagen al menu
                            
                            ['label' => Html::img('@web/img/en.png',['alt'=>'Inglés']).
                                '  '.Yii::t('app','Inglés'),
                                'url' => ['/site/langen'],
                                'language'=> ['en'],
                                'encode'=>false],
                        ],
                        'options' => [
                            'class' => 'menu-item',
                            'target' => '_self',
                        ],
                    ],

                    [
                        'label' => 'Administrador',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
