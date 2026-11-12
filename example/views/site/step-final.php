<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos-wizflow
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\wizflow\FinalForm */
/* @var $form ActiveForm */
?>
<div class="wizflow-step-final">

    <div class="row">
        <div class="col-lg-2">
            <h3>Summary</h3>
            <hr/>
            <?php
            foreach ($path as $step) {
                echo $step->summary() . '<br/>';
            }
            ?>
        </div>
        <div class="col-lg-10">
            <div class="alert alert-info">
                That's intresting and we reached the end of the wizards steps. How did you like our little talk together ?
            </div>

            <?php $form = ActiveForm::begin([
                'action' => ['', 'nav' => 'finish']
            ]); ?>

            <?= $form->field($model, 'rate')->radioList([
                'cool' => 'Yes that was cool',
                'supercool' => 'It was super cool man !',
            ]) ?>

            <div class="form-group">
                <hr/>
                <?= Html::a('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Prev', ['', 'nav' => 'prev'], ['class' => 'btn  btn-primary', 'role' => 'button']) ?>&nbsp;
                <?= Html::submitButton('Finish', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div><!-- wizflow-step-final -->
