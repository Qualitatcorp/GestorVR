<?php $this->beginContent('//layouts/main'); ?>

    <div class="row">
        <div class="col-md-3">
            <!-- It can be fixed with bootstrap affix http://getbootstrap.com/javascript/#affix-->
            <div id="sidebar" class="well sidebar-nav">
                <h5><i class="glyphicon glyphicon-home"></i>
                    <small><b>EMPRESA</b></small>
                </h5>
                    <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items'=>$this->menu,
                            'htmlOptions'=>array('class'=>'nav nav-pills nav-stacked'),
                        ));
                    ?>
            </div>
        </div>
        <div class="col-md-9">
            <?php echo $content; ?>
        </div>
</div>
<?php $this->endContent(); ?>