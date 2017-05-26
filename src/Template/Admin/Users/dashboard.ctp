<div id="page-wrapper">
	<div class="row">
		<?php  echo $this->Flash->render(); ?>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			
			<div class="panel panel-default">
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							 <div id="chart_of_users"></div>

						</div>
						<!-- /.col-lg-8 (nested) -->
					</div>
					<!-- /.row -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
			<!-- /.panel -->
		</div>
		
		<!-- /.col-lg-4 -->
	</div>
	<!-- /.row -->
</div>
        <!-- /#page-wrapper -->
<?php echo $this->Html->css(array(
	'admin/plugins/jquery.jqplot.min.css'),
	array('block' =>'css')); ?>      
	<!-- /#page-wrapper -->
<?php echo $this->Html->script(array(
	'admin/plugins/jquery.jqplot.min.js', 
	'admin/plugins/jqplot.barRenderer.min.js',
	'admin/plugins/jqplot.pieRenderer.min.js',
	'admin/plugins/jqplot.categoryAxisRenderer.min.js',
	'admin/plugins/jqplot.pointLabels.min.js'),
	array('block' =>'bottom')); ?>
	
<?php $this->Html->scriptStart(array('inline' => true,'block' => 'custom_script')); ?>
	var barSeriesDefault	=	{
		renderer:$.jqplot.BarRenderer,
		pointLabels: { show: true },
		rendererOptions: {
		barPadding: 8,
		barMargin: 10,
		barWidth: 15,
		barDirection: 'vertical',
		shadowOffset: 2,
		shadowDepth: 5,
		shadowAlpha: 0.8,
			
		},
	};

	/** USERS  #START **/
	$(document).ready(function(){
			var ticks1 = new Array();
			var var1	=	[];
			var var2	=	[];
			var var3	=	[];
			
			<?php 
			if(!empty($clinicUser)){
				$i	=	1;
				foreach($clinicUser as $key => $clinic){
					?>
					ticks1.push([ "<?php echo $key; ?>"]);
					var1.push([<?php echo $i; ?>, <?php echo $clinic; ?>]);
					<?php
					$i++;
				}
			} ?>
			
		
		
		plot2 = $.jqplot('chart_of_users', [var1], {
						
		seriesDefaults: barSeriesDefault,
					
		seriesColors:['red'],	// colors of the bar
									
		series:			
		[
			{label: "No. of User"}
			
		],
					
	legend:			
		{
		   renderer: $.jqplot.EnhancedLegendRenderer,
		   show:true,
		   location: 'nw',
		},
								
	axes: 
		{
			xaxis: {
				renderer: $.jqplot.CategoryAxisRenderer,
				ticks: ticks1,
				//tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
				axisLabel: "Months",
				axisLabelUseCanvas: true,
				axisLabelFontSizePixels: 12,
				axisLabelFontFamily: 'Verdana, Arial',
				
			},
			yaxis: {
				axisLabel: "No. of users",
				axisLabelUseCanvas: true,
				axisLabelFontSizePixels: 12,
				axisLabelFontFamily: 'Verdana, Arial',
				axisLabelPadding: 3,
			},
		},
													
	 highlighter: 
		{
			showMarker: false,
			tooltipAxes: 'xy',
			showTooltip: true,
			show: true,
			sizeAdjust: 10,
			tooltipContentEditor:customCompanyTooltip
			
		},
				
	});
	});
	
	function customCompanyTooltip(str, seriesIndex, pointIndex, plot) {
		var label	=	'';
		if(seriesIndex == 0)
			label	=	"No. of Active Users";
		else if(seriesIndex == 1)
			label	=	"No. of Active Artist";
		
		var users	=	str.split(', ')
		//return label+ ' :  ' + users[1];
		return plot.series[seriesIndex]["label"] + "<br> " + plot.options.axes.xaxis.ticks[pointIndex] + " : " + users[1];
	}
	
<?php $this->Html->scriptEnd(); ?>