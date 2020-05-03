<?php

namespace app\components;
use yii\grid\ActionColumn;
use Yii;
use yii\helpers\Html;

class MyActionColumn extends ActionColumn
{
	protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
		if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                $style = 'btn-default';
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'Visualizar');
                        $style = 'btn-warning';
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Editar');
                        $style = 'btn-primary';
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Excluir');
                        $style = 'btn-danger';
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('span', '', ['class' => "btn $style glyphicon glyphicon-$iconName"]);
                return Html::a($icon, $url, $options);
            };
        }
	}
}

?>