<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\wizflow\widgets
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

namespace open20\amos\wizflow\widgets;

use open20\amos\core\helpers\Html;
use open20\amos\core\module\BaseAmosModule;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

/**
 * Class WizflowPrevAndContinueButtonWidget
 * @package open20\amos\wizflow\widgets
 */
class WizflowPrevAndContinueButtonWidget extends Widget
{
    /**
     * @var string $layout
     */
    public $layout = '<div class="col-lg-12 nop"><div class="col-md-6 nop">{buttonPrevious}</div><div class="col-md-6 nop">{buttonContinue}</div></div>';
    public $continueLabel = '';
    public $continueGrahpic = '';
    public $continueOptions = [];
    public $viewPreviousBtn = true;
    public $previousLabel = '';
    public $previousGrahpic = '';
    public $previousOptions = [];

    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $content = preg_replace_callback("/{\\w+}/", function ($matches) {
            $content = $this->renderSection($matches[0]);
            return $content === false ? $matches[0] : $content;
        }, $this->layout);
        return $content;
    }

    /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{summary}`, `{items}`.
     * @return string|boolean the rendering result of the section, or false if the named section is not supported.
     */
    public function renderSection($name)
    {
        switch ($name) {
            case '{buttonContinue}':
                return $this->renderButtonContinue();
            case '{buttonPrevious}':
                return $this->renderButtonPrevious();
            default:
                return false;
        }
    }

    public function renderButtonContinue()
    {
        $internalOptions = ['class' => 'btn btn-primary pull-right'];
        $allOptions = ArrayHelper::merge($internalOptions, $this->continueOptions);
        if (!$this->continueLabel) {
            $this->continueLabel = BaseAmosModule::tHtml('amoswizflow', 'Continue');
        }
        if (!$this->continueGrahpic) {
            $this->continueGrahpic = ' <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>';
        }
        return Html::submitButton($this->continueLabel . $this->continueGrahpic, $allOptions);
    }

    public function renderButtonPrevious()
    {
        if (!$this->viewPreviousBtn) {
            return '';
        }

        $internalOptions = ['class' => 'btn btn-primary pull-left'];
        $allOptions = ArrayHelper::merge($internalOptions, $this->previousOptions);
        if (!$this->previousLabel) {
            $this->previousLabel = BaseAmosModule::tHtml('amoswizflow', 'Go back');
        }
        if (!$this->previousGrahpic) {
            $this->previousGrahpic = '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> ';
        }
        return Html::a($this->previousGrahpic . $this->previousLabel, ['wizard', 'nav' => 'prev'], $allOptions);
    }
}
