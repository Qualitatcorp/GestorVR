<?php $this->beginContent('//layouts/main'); ?>

    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
            <!-- It can be fixed with bootstrap affix http://getbootstrap.com/javascript/#affix-->
            <div id="sidebar" class="well list-group">
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
        <div class="col-xs-12 col-sm-9">
            <p class="pull-left visible-xs">
                <button type="button" class="btn" data-toggle="offcanvas">Opciones</button>
            </p>
            <?php echo $content; ?>
        </div>
</div>
<?php $this->endContent(); ?>