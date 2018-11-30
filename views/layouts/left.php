<?php 
use yii\helpers\Html;
use mdm\admin\components\Helper;
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
                        .'</p>'.
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
                    [
                     'label' => Html::img('@web/img/iso 9001.png',
                     [
                      'alt'     => 'Menu de opciones',
                      'width'   => '20px'
                     ]).
                      '  '.Yii::t('app','Menu de opciones'),
                      'encode'  => false,
                      'options' => ['class' => 'header']
                    ],
                    [
                     'label'    => 'Principal',
                     'icon'     => 'home',
                     'url'      => ['/site/index'],
                     'visible'  => Helper::checkRoute('/site/index')
                    ],
                    [
                     'label'    => 'Iniciar sesion',
                     'url'      => ['/site/login'],
                     'visible'  => Yii::$app->user->isGuest
                    ],
                    [
                     'label'    => \Yii::t('app','Usuarios'),
                     'icon'     => 'user-o',
                     'items'    => [
                                    [
                                     'label'   => 'Registrar nuevo',
                                     'icon'    => 'plus',
                                     'url'     => ['/site/signup'],
                                     'visible' => Helper::checkRoute('/site/signup')
                                    ],
                                    [
                                     'label'   => 'Modificar datos',
                                     'icon'    => 'pencil',
                                     'url'     => ['/site/update'],
                                     'visible' => Helper::checkRoute('/site/update')
                                    ],
                                   ],
                    ],
                    [
                     'label'    => 'Infraestructura',
                     'icon'     => 'building',
                     'items'    => [
                                    [
                                     'label'   => 'Pisos',
                                     'icon'    => 'building',
                                     'url'     => ['/piso'],
                                     'visible' => Helper::checkRoute('ambiente/index')
                                    ],
                                    [
                                     'label'   => 'Ambientes',
                                     'icon'    => 'map',
                                     'url'     => ['/ambiente'],
                                     'visible' => Helper::checkRoute('ambiente/index')
                                    ],
                                   ],
                    ],
                    [
                     'label'   => 'Personas',
                     'icon'    => 'address-book-o',
                     'url'     => ['/persona'],
                     'visible' => Helper::checkRoute('persona/index'),
                     'items'    => [
                                    [
                                     'label'   => 'Registrar nuevo',
                                     'icon'    => 'plus',
                                     'url'     => ['/persona/create'],
                                     'visible' => Helper::checkRoute('persona/create')
                                    ],
                                    [
                                     'label'   => 'Consulta',
                                     'icon'    => 'search',
                                     'url'     => ['/persona/listado'],
                                     'visible' => Helper::checkRoute('persona/listado')
                                    ],
                                   ],
                    ],
                    [
                     'label'   => 'Articulos',
                     'icon'    => 'cubes',
                     'url'     => ['/articulo'],
                     'visible' => Helper::checkRoute('articulo/index'),
                     'items'    => [
                                    [
                                     'label'   => 'Registrar nuevo',
                                     'icon'    => 'plus',
                                     'url'     => ['/articulo/create'],
                                     'visible' => Helper::checkRoute('articulo/create')
                                    ],
                                    [
                                     'label'   => 'Consulta',
                                     'icon'    => 'search',
                                     'url'     => ['/articulo'],
                                     'visible' => Helper::checkRoute('articulo')
                                    ],
                                   ],
                    ],
                    [
                     'label'   => 'Prestamos',
                     'icon'    => 'money',
                     'url'     => ['/prestamo'],
                     'visible' => Helper::checkRoute('prestamo/index'),
                     'items'    => [
                                    [
                                     'label'   => 'Registrar nuevo',
                                     'icon'    => 'plus',
                                     'url'     => ['/prestamo/create'],
                                     'visible' => Helper::checkRoute('prestamo/create')
                                    ],
                                    [
                                     'label'   => 'Consulta',
                                     'icon'    => 'search',
                                     'url'     => ['/prestamo'],
                                     'visible' => Helper::checkRoute('prestamo')
                                    ],
                                   ],
                    ],
                    [
                     'label'   => 'Devoluciones',
                     'icon'    => 'dropbox',
                     'url'     => ['/devolucion'],
                     'visible' => Helper::checkRoute('devolucion/index'),
                     'items'    => [
                                    [
                                     'label'   => 'Registrar nuevo',
                                     'icon'    => 'plus',
                                     'url'     => ['/devolucion/create'],
                                     'visible' => Helper::checkRoute('devolucion/create')
                                    ],
                                    [
                                     'label'   => 'Consulta',
                                     'icon'    => 'search',
                                     'url'     => ['/devolucion'],
                                     'visible' => Helper::checkRoute('devolucion')
                                    ],
                                   ],
                    ],
                    [
                     'label'   => 'Reportes',
                     'icon'    => 'file-pdf-o',
                     'items'   => [
                                    [
                                      'label'   => 'Personas',
                                      'icon'    => 'address-book-o',
                                      'url'     => ['/persona/reporte'],
                                      'target'  => '_blank', 
                                      'visible' => Helper::checkRoute('/persona/reporte')
                                    ]
                                  ]
                    ],
                    [
                     'label'   => 'Estadisticas',
                     'icon'    => 'bar-chart',
                     'items'   => [
                                    [
                                      'label'   => 'Personas',
                                      'icon'    => 'address-book-o',
                                      'url'     => ['/persona'],
                                      'target'  => '_blank', 
                                      'visible' => Helper::checkRoute('/persona')
                                    ]
                                  ]
                    ],
                    [
                     'label' => \Yii::t('app','Idioma'),
                     'icon'  => 'globe',
                     'items' => [
                                 [
                                  'label'    => Html::img('@web/img/es.png',
                                   ['alt'    => 'Español']).'  '.Yii::t('app','Español'),
                                  'url'      => ['/site/langes'],
                                  'language' => ['es'],
                                  'encode'   => false
                                 ], //necesario para poder agregar imagen al menu
                                 [
                                  'label'    => Html::img('@web/img/en.png',
                                  ['alt'     => 'Inglés']).'  '.Yii::t('app','Inglés'),
                                  'url'      => ['/site/langen'],
                                  'language' => ['en'],
                                  'encode'   => false],
                                ],
                     'options' => [
                                   'class'  => 'menu-item',
                                   'target' => '_self',
                                  ],
                      'visible' => Helper::checkRoute('/site/langes')
                    ],

                    [
                        'label' => 'Administrador',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                                    [
                                     'label'   => 'Roles y permisos',
                                     'icon'    => 'user-plus',
                                     'url'     => ['/admin'],
                                     'visible' => Helper::checkRoute('/admin')
                                    ],
                                    [
                                     'label'   => 'Gii',
                                     'icon'    => 'file-code-o',
                                     'url'     => ['/gii'],
                                     'visible' => Helper::checkRoute('/gii')
                                    ],
                                    [
                                     'label'   => 'Debug',
                                     'icon'    => 'dashboard',
                                     'url'     => ['/debug'],
                                     'visible' => Helper::checkRoute('/debug')
                                    ],
                                    ],
                        'visible' => Helper::checkRoute('/admin')
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
