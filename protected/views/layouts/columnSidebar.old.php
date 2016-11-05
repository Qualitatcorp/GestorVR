<?php $this->beginContent('//layouts/main'); ?>

    <div class="row">
        <div class="col-md-3">
            <!-- It can be fixed with bootstrap affix http://getbootstrap.com/javascript/#affix-->
            <div id="sidebar" class="well sidebar-nav">
                <h5><i class="glyphicon glyphicon-home"></i>
                    <small><b>OPCIONES</b></small>
                </h5>
                    <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'items'=>$this->menu,
                            'htmlOptions'=>array('class'=>'nav nav-pills nav-stacked'),
                        ));
                    ?>
            </div>
            <?php
                // $this->beginWidget('zii.widgets.CPortlet', array(
                //     'title'=>BsHtml::icon(BsHtml::GLYPHICON_GLOBE).BsHtml::bold(' Gestor VR').BsHtml::small(' Qualitatcorp'),
                //     'htmlOptions'=>array('class'=>'well sidebar-nav'),
                // ));
                //     $this->widget('zii.widgets.CMenu', array(
                //         'items'=>$this->menu,
                //         'htmlOptions'=>array('class'=>'nav nav-pills nav-stacked'),
                //     ));
                // $this->endWidget();
            ?>
        </div>
        <div class="col-md-9">
            <?php echo $content; ?>
        </div>
</div>
<?php $this->endContent(); ?>