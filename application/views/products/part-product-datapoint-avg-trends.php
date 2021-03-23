<?php
	//$colors=$this->config->item('chart-colors');
	$chart_id=random_string('alnum', 4);
	$chart_url="product/trend/$product->id/$datapoint->id/?usr_submit=tru&criteria=provider";

	$series=array();
	
	foreach($providers as $provider)
	{
		$points=array(); $d_points=$product->get_datapoints(array(
			'datapoint'=>$datapoint->id,
			'provider'=>$provider->id
		));

		//var_dump($product->name, $provider->name, $datapoint->name, $datapoints);
		if(count($d_points))
		{
			foreach ($d_points as $d_point)$points[]=(int)$d_point->value;

			$series[]=array(
				'name'=>$provider->name,
				'data'=>$points
			);
		}
	}
?>

<div  data-chart-id="<?php echo $chart_id; ?>" data-type="line" data-chart-url="<?php echo base_url($chart_url); ?>"  class="trend-chart time-series datapont-avg-trend row">
	<div class="content">
		<div class="chart-canvas" style="width:1024px; height: 200px; padding: 0px; margin: 0px;"></div>
	</div>
	<script class="js-data-script" type="text/javascript">
		(function productDataChartData(){
			window.chartData=(window.chartData || {});
			window.chartData['<?php echo $chart_id; ?>']={
        		title: {
		            text: '<?php echo ucwords(strtolower($datapoint->name)); ?>'+' Trend'
		        },
		        xAxis: {
		            categories:[
		            	'January', 
		            	'February', 
		            	'March', 
		            	'April', 
		            	'May', 
		            	'June', 
		            	'July', 
		            	'August', 
		            	'September', 
		            	'October', 
		            	'November', 
		            	'December'
		            ]
		        },
		        yAxis: {
		            title: {
		                text: '<?php echo ucwords(strtolower("$datapoint->name ($datapoint->units)")); ?>'
		            }
		        },
		        series:<?php echo json_encode($series); ?>
			};
		}());
	</script>
</div>