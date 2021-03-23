(function($){
	$(function(){	
		//Products page
		function panelTabs(e){
			e.preventDefault();
			var parentContainer=$(this).parent().parent().parent();
			parentContainer.find('.tab-content .tab-pane.active').removeClass('active');
			parentContainer.find($(this).attr('href')+'.tab-pane').addClass('active');
			parentContainer.find('.tab-content .tab-pane').hide();
			parentContainer.find('.tab-content .tab-pane.active').fadeIn();
			parentContainer.find('.nav-tabs li.active').removeClass('active');
			$(this).parent().addClass('active');
		}

		//Render chart
		 function renderChart(){
		 	var self=$(this),
		 		chartID=self.attr('data-chart-id'),
		 		chartDataScript=eval(self.find('.js-data-script').text()),
		 		chartData=window.chartData[chartID];
		 	chartData['chart']={
		 		'type':self.attr('data-type')
		 	};
		 	//console.log(chartData);
		 	self.highcharts(chartData);
		 }

		$('#product-trends a').click(panelTabs);

		$('#product-data-table a').click(panelTabs);

		$('#providers-tabs a').click(panelTabs);

		$('.product-data-trends-tabs').each(function(index, tabs){
			$(tabs).find('a').click(panelTabs);
		});

		//Add Data
		$('.add-data-modal').each(function(index, modal){
			 var modal=$(modal).modal('hide');
			 modal.find('.save-btn').click(function(){
			 	var dataForm=modal.find('.save-data-form'),
			 		datapoint=dataForm.find('.datapoint').val(),
			 		product=dataForm.find('.product').val(),
			 		provider=dataForm.find('.provider').val(),
			 		region=dataForm.find('.region').val(),
			 		owner=dataForm.find('.owner').val(),
			 		value=dataForm.find('.value').val(),
			 		date=dataForm.find('.date').val();

			   dataForm.find('.form-message').fadeOut().remove();

			    if(datapoint && product && provider && region && owner && value && date){
				 	modal.find('.loader').removeClass('hidden');
				 	$.post(dataForm.attr('data-save-url'), {
				 		'datapoint[datapoint]':datapoint,
				 		'datapoint[product]':datapoint,
				 		'datapoint[provider]':provider,
				 		'datapoint[region]':region,
				 		'datapoint[owner]':owner,
				 		'datapoint[value]':value,
				 		'datapoint[date]':date,
				 		'usr_submit':true
				 	},function(data){
				 		if(data && data.hasOwnProperty('error') && !data['error']){
					 		modal.find('.loader').addClass('hidden');
				 			modal.find('.success').removeClass('hidden').fadeIn();
					 		setTimeout(function(){
					 			modal.find('.success').fadeOut(function(){
					 				modal.find('.success').addClass('hidden');
					 				modal.find('.loader').removeClass('hidden');
					 				setTimeout(function(){
					 					window.location.reload();
					 					modal.modal('hide');
					 				},1000);
					 			});
					 		}, 2000);
					 	}else{
			    			dataForm.prepend('<div class="form-message form-group text-center"><span class="alert alert-danger">'+data['message']+'</span></div><br/>');
					 	}
				 	}, 'json');
			    }
			    else{
			    	dataForm.prepend('<div class="form-message form-group text-center"><span class="alert alert-danger">Please complete the form before submitting</span></div><br/>');
			    }
			 });
		});

		//Compare Data
		$('.compare-data-modal').each(function(index, modal){
			 var modal=$(modal).modal('hide');
			 modal.find('.criteria').change(function(e){
			 	e.preventDefault();
			 	var compareForm=modal.find('.compare-form'),
			 		criteria=compareForm.find('.criteria').val();
			 	compareForm.find('.form-message').fadeOut().remove();
			    if(criteria){
				 	modal.find('.loader').removeClass('hidden');
				 	$.post(compareForm.attr('data-compare-url'), {
				 		'criteria':criteria,
				 		'usr_submit':true
				 	},function(data){
				 		var chart=$(data);
				 		modal.find('.chart-url').val(chart.attr('data-chart-url'));
				 		modal.find('.chart').html(chart);
				 		renderChart.apply(chart);
				 		modal.find('.loader').addClass('hidden');
				 	});
			    }
			    else{
			    	compareForm.prepend('<div class="form-message form-group text-center"><span class="alert alert-danger">Please select a criteria</span></div><br/>');
			    }
			 });

			 modal.find('.save-chart').click(function(e){
			 	 e.preventDefault();
			 	 var chartDetailsForm=modal.find('.chart-form'),
			 	 	 chartName=chartDetailsForm.find('.chart-name').val(),
			 	 	 chartUrl=chartDetailsForm.find('.chart-url').val();

			    chartDetailsForm.find('.form-message').fadeOut().remove();
			 	 if(chartName && chartUrl){
				 	modal.find('.loader').removeClass('hidden');
				 	$.post(chartDetailsForm.attr('data-save-url'), {
				 		'chart[name]':chartName,
				 		'chart[url]':chartUrl
				 	},function(data){
				 		modal.find('.success').removeClass('hidden');
				 		modal.find('.loader').addClass('hidden');
				 		setTimeout(function(){
				 			modal.find('.success').addClass('hidden');
			    			chartDetailsForm.prepend('<div class="form-message form-group text-center"><span class="alert alert-success">Chart saved!</span></div><br/>');
				 		}, 1000);
				 	});
			 	 }
			 	 else{
			    	chartDetailsForm.prepend('<div class="form-message form-group text-center"><span class="alert alert-danger">Please fill in all the chart details</span></div><br/>');
			 	 }
			 });
		});

		//Product Datapoint Avg Trends
		var timeSeriesDatapointTrendLineChart=$('.trend-chart.time-series.datapont-avg-trend');
		timeSeriesDatapointTrendLineChart.each(function(index, chart){
			renderChart.apply($(chart));
		});
	});
}(window.jQuery));