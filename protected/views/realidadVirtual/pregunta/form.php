<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableClientValidation'=>true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="help-block">Los campos con un <span class="required">*</span> son requeridos.</p>
    <?= $form->errorSummary($model); ?> 
    <?= $form->fileFieldControlGroup($model,'imagen'); ?>
    <?= $form->textAreaControlGroup($model,'descripcion',array('rows'=>2)); ?>
    <?= $form->textFieldControlGroup($model,'comentario'); ?>
    <?= $form->dropDownListControlGroup($model,'habilitado',array('SI'=>'SI','NO'=>'NO'));?>
    <?php //BsHtml::formActions(array(BsHtml::submitButton('Guardar pregunta y alternativas', array('color' => BsHtml::BUTTON_COLOR_PRIMARY))));?>
    <h2>Alternativas</h2>
    <table class="table" id="tableAlternativas">
    	<thead>
    		<tr>
    			<th style="width:80px">Alternativa*</th>
    			<th>Descripción</th>
    			<th style="width:50px">Ponderación*</th>
    			<th style="width:85px">Correcta*</th>
    			<th style="width:20px"></th>
    		</tr>
    	</thead>
    	<tbody>
    	<?php foreach ($list as $key => $value): ?>
			<tr>
	         <th><?= $form->textField($value, "[$key]alternativa", array('required'=>true));?></th>
	         <td><?= $form->textArea($value, "[$key]descripcion", array('rows'=>1));?></td>
	         <td><?= $form->numberField($value, "[$key]ponderacion", array('min'=>0,'step'=>"0.1",'required'=>true));?></td>
	         <td><?= $form->dropDownList($value, "[$key]correcta", array("SI"=>"SI","NO"=>"NO"),array());?></td>
	         <td><?= BsHtml::button('Eliminar', array('color' => BsHtml::BUTTON_COLOR_DANGER,'onClick'=>'$(this).closest("tr").remove()')); ?></td>
	         </tr>
    	<?php endforeach ?>
    	</tbody>
    </table>
    <script type="text/javascript">
    <?php $alt=new RvAlternativa; ?>
    var contador=-1;
    $(function(){
    	$('#add').click(function(){
    		// window.alert(5 + 6);
    		$('#tableAlternativas').each(function(){
    			if (contador==-1) {
    				contador=$('tbody tr', this).length;
    			}else{
    				contador++;
    			}
		         var tds = 
			         `<tr>
				         <th><?= $form->textField($alt, "[{n}]alternativa", array('required'=>true));?></th>
				         <td><?= $form->textArea($alt, "[{n}]descripcion", array('rows'=>1));?></td>
				         <td><?= $form->numberField($alt, "[{n}]ponderacion", array('min'=>0,'step'=>"0.1","value"=>1,'required'=>true));?></td>
				         <td><?= $form->dropDownList($alt, "[{n}]correcta", array("SI"=>"SI","NO"=>"NO"),array());?></td>
				         <td><?= BsHtml::button('Eliminar', array('color' => BsHtml::BUTTON_COLOR_DANGER,'onClick'=>'$(this).closest("tr").remove()')); ?></td>
			         </tr>`;
		         var td=`<tr>`
		         if ($('tbody', this).length > 0) {
		             $('tbody', this).append(tds.replace(/{n}/g,contador));
		         } else {
		             $(this).append(tds);
		         }
    		})
    	});
	});
    </script>
    <?=BsHtml::button('Agregar alternativa',array('id'=>'add')) ?>
    <?=BsHtml::button('Volver a evaluación',array('onClick'=>"window.location.href='../viewEva/$model->eva_id'")) ?>
    <?=BsHtml::submitButton('Guardar pregunta y alternativas', array('color' => BsHtml::BUTTON_COLOR_PRIMARY));?>
<?php $this->endWidget(); ?>