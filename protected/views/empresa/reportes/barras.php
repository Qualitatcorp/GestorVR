<?php 
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options' => array(
      'title' => array('text' => 'Grafico de produccion'),
      'xAxis' => array(
         'categories' => array('Apples', 'Bananas', 'Oranges')
      ),
      'yAxis' => array(
         'title' => array('text' => 'Pichula')
      ),
      'series' => array(
         array('name' => 'Jane', 'data' => array(1, 0, 4,12)),
         array('name' => 'John', 'data' => array(5, 7, 3))
      )
   )
));
$this->Widget('ext.highcharts.HighchartsWidget', array(
   'options' => '{
      "title": { "text": "Fruit Consumption" },
      "xAxis": {
         "categories": ["Apples", "Bananas", "Oranges"]
      },
      "yAxis": {
         "title": { "text": "Fruit eaten" }
      },
      "series": [
         { "name": "Jane", "data": [1, 0, 4] },
         { "name": "John", "data": [5, 7,3] }
      ]
   }'
));