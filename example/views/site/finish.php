<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
?>
<h1>We are done : Thanks ! </h1>
<div class="row">
    <div class="col-md-12">
        <h3>Let's summarize your replies : </h3>
        <hr/>
        <div class="well">
            <?php
            foreach ($path as $step) {
                echo $step->summary() . '<br/>';
            }
            ?>
        </div>
        <p><?= Html::a('Start the Wizflow one more time !!', ['wizflow', 'nav' => 'start']) ?></p>
    </div>
</div>
