<?php
	//$colors=$this->config->item('chart-colors');
	$chart_id=random_string('alnum', 4);
	$chart_url="product/compare/$product->id/$datapoint->id/?usr_submit=true";
	$data=array();
	$index=array(
		'Jan'=>0, 
		'Feb'=>1, 
		'Mar'=>2,
		'Apr'=>3, 
		'May'=>4, 
		'Jun'=>5, 
		'Jul'=>6, 
		'Aug'=>7, 
		'Sep'=>8, 
		'Oct'=>9, 
		'Nov'=>10, 
		'Dec'=>11
    );

	foreach($series as $current_series)
	{
		$points=array(0,0,0,0,0,0,0,0,0,0,0,0); $params=array();
		$params['datapoint']=$datapoint->id;
		$params[$series_attr]=$current_series->id;
		$d_points=$product->get_datapoints($params);

		if(count($d_points))
		{
			foreach ($d_points as $d_point){
				$month=ucwords(strtolower(date('M', $d_point->date)));
				$points[$index[$month]]=(int)$d_point->value;
			}

			$data[]=array(
				'name'=>$current_series->name,
				'data'=>$points
			);
		}
	}
?>

<div  data-chart-id="<?php echo $chart_id; ?>" data-type="bar" data-chart-url="<?php echo base_url($chart_url); ?>"  class="trend-chart time-series datapont-avg-trend row">
	<div class="content">
		<div class="chart-canvas" style="width:1024px; height: 200px; padding: 0px; margin: 0px;"></div>
	</div>
	<script class="js-data-script" type="text/javascript">
		(function productDataChartData(){
			window.chartData=(window.chartData || {});
			window.chartData['<?php echo $chart_id; ?>']={
        		title: {
		            text: '<?php echo ucwords(strtolower($datapoint->name)); ?>'+' of <?php echo ucwords($product->name); ?>'+' Comparison Among'+' <?php echo ucwords(strtolower($series_attr)); ?>s'
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
		        series:<?php echo json_encode($data); ?>
			};
		}());
	</script>
</div>