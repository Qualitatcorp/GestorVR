
<?= BsHtml::pageHeader(Yii::t('app', 'Select language')) ?>
<?php 
 echo BsHtml::beginForm();
	  echo  BsHtml::dropDownListControlGroup('language',Yii::app()->Language,Yii::app()->params['language'],array(
    'empty' => 'Elija ...',
	)
	);?>
<?php
echo BsHtml::submitButton(Yii::t('app', 'next'), array(
    'color' => BsHtml::BUTTON_COLOR_PRIMARY
));
?>