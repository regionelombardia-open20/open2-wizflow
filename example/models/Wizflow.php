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

use raoul2000\workflow\source\file\IWorkflowDefinitionProvider;

/**
 * This is the workflow definition. Metadata is used at each wizard step
 * to store model and view names.
 */
class Wizflow implements IWorkflowDefinitionProvider
{
    public function getDefinition()
    {
        return [
            'initialStatusId' => 'welcome',
            'status' => [
                'welcome' => [
                    'transition' => ['step1'],
                    'metadata' => [
                        'model' => [
                            'class' => '\app\models\WelcomeForm'
                        ],
                        'view' => 'step-welcome'
                    ]
                ],
                'step1' => [
                    'transition' => ['blue', 'green'],
                    'metadata' => [
                        'model' => [
                            'class' => '\app\models\Step1Form'
                        ],
                        'view' => 'step-1'
                    ]
                ],
                'blue' => [
                    'transition' => ['final'],
                    'metadata' => [
                        'model' => [
                            'class' => '\app\models\BlueForm'
                        ],
                        'view' => 'step-blue'
                    ]
                ],
                'green' => [
                    'transition' => ['final'],
                    'metadata' => [
                        'model' => [
                            'class' => '\app\models\GreenForm'
                        ],
                        'view' => 'step-green'
                    ]
                ],
                'final' => [
                    'transition' => [],
                    'metadata' => [
                        'model' => [
                            'class' => '\app\models\FinalForm'
                        ],
                        'view' => 'step-final'
                    ]
                ]
            ]
        ];
    }
}
