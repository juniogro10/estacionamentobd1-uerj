<?

use yii\helpers\Html;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->

        <?
        $menuItems = [];

        if (!isset($this->params['dataset'])) {
            $menuItems = [
                ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                ['label' => 'Obter dados', 'icon' => 'fa fa-upload', 'url' => ['/app/'], 'options' => ['class' => ('default' == Yii::$app->controller->id && Yii::$app->controller->action->id == 'index') ? 'active' : '']],
                ['label' => 'Conjunto de dados', 'icon' => 'fa fa-database', 'url' => ['/app/dataset']],
            ];

        } else {

            $menuItems = [
                ['label' => $this->params['dataset'], 'options' => ['class' => 'header']],
                ['label' => 'Painéis', 'icon' => 'fa fa-dashboard', 'url' => ['dashboard']],
                ['label' => 'Relatórios', 'icon' => 'fa fa-line-chart', 'url' => ['dataset/'.$this->params['dataset_id'].'/report']],
                ['label' => 'Tabelas', 'icon' => 'fa fa-table', 'url' => ['dataset/'.$this->params['dataset_id'].'/table']],
                ['label' => 'Relacionamentos', 'icon' => 'fa fa-cubes', 'url' => ['relationship']],

            ];


        }

        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => $menuItems,

            ]
        ) ?>

    </section>
</aside>
