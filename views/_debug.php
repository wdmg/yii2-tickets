<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

if (YII_ENV_DEV) : ?>
    <div style="clear:both; padding: 10px 0px 15px 0px;"></div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="panel-title">
                <a data-toggle="collapse" href="#collapsePanel1">
                    Debug Data
                </a>
            </h5>
        </div>
        <div id="collapsePanel1" class="panel-collapse collapse">
            <div class="panel-body">
                <dl class="dl-horizontal" style="margin-bottom:0;">
                    <dt>Module ID:</dt>
                    <dd><code><?= $this->context->module->id ?></code></dd>
                    <dt>Module version:</dt>
                    <dd><code><?= $this->context->module->version ?></code></dd>
                    <dt>Module vendor:</dt>
                    <dd><code><?= $this->context->module->vendor ?></code></dd>
                    <dt>Routing prefix:</dt>
                    <dd><code><?= $this->context->module->routePrefix ?></code></dd>
                    <dt>Action ID:</dt>
                    <dd><code><?= $this->context->action->id ?> (<?= $this->context->action->uniqueId ?>)</code></dd>
                    <dt>Controller ID:</dt>
                    <dd><code><?= get_class($this->context) ?></code></dd>
                </dl>
            </div>
        </div>
    </div>
<? endif; ?>