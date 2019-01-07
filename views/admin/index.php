<div class="page-header">
    <h1><span class="text-uppercase"><?= $this->context->module->id ?></span> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
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
                <dt>Action ID:</dt>
                <dd><code><?= $this->context->action->id ?> (<?= $this->context->action->uniqueId ?>)</code></dd>
                <dt>Controller ID:</dt>
                <dd><code><?= get_class($this->context) ?></code></dd>
                <dt>Path to this view:</dt>
                <dd><code><?= __FILE__ ?></code></dd>
                <dt>Module vendor:</dt>
                <dd><code><?= $this->context->module->vendor ?></code></dd>
                <dt>Routing prefix:</dt>
                <dd><code><?= $this->context->module->routePrefix ?></code></dd>
            </dl>
        </div>
    </div>
</div>