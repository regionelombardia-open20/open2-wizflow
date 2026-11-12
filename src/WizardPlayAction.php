<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\wizflow
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

namespace open20\amos\wizflow;

use Yii;
use yii\base\Model;
use yii\helpers\BaseFileHelper;
use yii\validators\FileValidator;
use yii\web\UploadedFile;

/**
 * Class WizardPlayAction
 * @package open20\amos\wizflow
 */
class WizardPlayAction extends \yii\base\Action
{
    public $wizardManagerName = 'wizflowManager';
    public $url = ['wizflow'];
    public $urlFinish = ['finish'];

    /**
     * @var string $tmpStorePath This is the tmp directory where the temp files are stored.
     */
    public $tmpStorePath = '';

    /**
     * @param string $nav
     * @return string
     */
    public function run($nav = 'start')
    {
        $wizard = Yii::$app->get($this->wizardManagerName);

        if ($nav == 'prev') {
            $model = $wizard->getPreviousStep();
            if ($model == null) {
                Yii::$app->controller->redirect(array_merge($this->url, ['nav' => 'start']));
            }
        } elseif ($nav == 'start') {
            $model = $wizard->start();
        } else {
            /** @var Model $model */
            $model = $wizard->getCurrentStep();
            if ($model == null) {
                $this->controller->redirect($this->urlFinish);
            } else {

                $oldModel = $model;
                if ($model->load(Yii::$app->request->post())) {

                    $validators = $model->validators;
                    /** @var FileValidator FileValidator */
                    foreach ($validators as $validator) {
                        if (is_a($validator, FileValidator::className(), true)) {
                            foreach ($validator->attributes as $attribute) {
                                $uploadedFile = UploadedFile::getInstance($model, $attribute);
                                if (empty($uploadedFile)) {
                                    $model->$attribute = $oldModel->$attribute;
                                } else {
                                    $model->$attribute = $this->saveTmpfile($uploadedFile);
                                }
                            }

                        }
                    }

                    if ($model->validate()) {
                        // current step has been completed : save it and get next step
                        $wizard->updateCurrentStep($model);
                        $model = $wizard->getNextStep();
                        if ($model == null) {
                            //we reached the last step : save it and go tp the finish page
                            $wizard->save();
                            $this->controller->redirect($this->urlFinish);
                        }
                    }
                    else {
                        $wizard->updateCurrentStep($model);
                    }
                } else {
                    if (empty($model)) {
                        $model = $wizard->getNextStep();
                        if ($model == null) {
                            $this->controller->redirect($this->urlFinish);
                        }
                    }
                }

            }
        }
        if ($model != null) {
            $viewname = $model->getWorkflowStatus()->getMetadata('view');
            $wizard->save();
            return $this->controller->render($viewname, [
                'model' => $model,
                'path' => $wizard->getPath()
            ]);
        }
    }

    /**
     * Store the file in a secure position
     *
     * @param UploadedFile $uploadedFile
     * @return UploadedFile
     */
    private function saveTmpfile($uploadedFile)
    {
        $storePath = $this->tmpStorePath;
        if (!strlen($storePath)) {
            $storePath = Yii::getAlias('@runtime') . DIRECTORY_SEPARATOR . 'wizflow';
        }

        if (!is_dir($storePath)) {
            BaseFileHelper::createDirectory($storePath, 0775, true);
        }
        $newTempfile = $storePath . DIRECTORY_SEPARATOR . basename($uploadedFile->tempName);
        if (copy($uploadedFile->tempName, $newTempfile)) {
            $uploadedFile->tempName = $newTempfile;
        }
        return $uploadedFile;
    }
}
