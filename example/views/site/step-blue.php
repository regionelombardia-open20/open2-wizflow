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
/* @var $model app\models\wizflow\BlueForm */
/* @var $form ActiveForm */
?>
<div class="wizflow-step-blue">

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
                Yes, blue is a nice color. Can you name the most beautiful thing you have ever seen with a blue color in it ?
            </div>

            <?php $form = ActiveForm::begin([
                'action' => ['', 'nav' => 'next']
            ]); ?>

            <?= $form->field($model, 'blueStuff') ?>

            <div class="form-group">
                <hr/>
                <?= Html::a('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Prev', ['', 'nav' => 'prev'], ['class' => 'btn  btn-primary', 'role' => 'button']) ?>&nbsp;
                <?= Html::submitButton('Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div><!-- wizflow-step-blue -->
