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

namespace app\models;

use raoul2000\workflow\validation\WorkflowScenario;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Step1Form extends Model implements \open20\amos\wizflow\WizflowModelInterface
{
    public $favoriteColor;
    public $status;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['favoriteColor'], 'required'],

            [['favoriteColor'], 'compare', 'compareValue' => 'blue', 'operator' => '==',
                'on' => WorkflowScenario::enterStatus('Wizflow/blue')],

            [['favoriteColor'], 'compare', 'compareValue' => 'green', 'operator' => '==',
                'on' => WorkflowScenario::enterStatus('Wizflow/green')],
        ];
    }

    public function summary()
    {
        return 'your favorite color is ' . $this->favoriteColor;
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'favoriteColor' => 'your favorite color',
        ];
    }
}
