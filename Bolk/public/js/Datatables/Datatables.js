// Datatable script
//linked datetimepicker
	var $searchcolumn= $column;
	$(function () {
        $('#startdatesearch').datetimepicker({
        	sideBySide: true,
			format: 'DD-MM-YYYY',
			calendarWeeks: true
        });
        $('#enddatesearch').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            sideBySide: true,
			format: 'DD-MM-YYYY',
			calendarWeeks: true
        });
        $("#startdatesearch").on("dp.change", function (e) {
            $('#enddatesearch').data("DateTimePicker").minDate(e.date);
           minDateFilter= e.date
           $table.DataTable().draw();
        });
        $("#enddatesearch").on("dp.change", function (e) {
            $('#startdatesearch').data("DateTimePicker").maxDate(e.date);
            maxDateFilter = e.date
           $table.DataTable().draw();
    	});
	});
	//DataTables search execution
	minDateFilter="";
	maxDateFilter="";
	$.fn.dataTable.ext.search.push(
	   function(oSettings, aData, iDataIndex) {
	   	if (minDateFilter == "" && maxDateFilter == "" ){
	   		return true;
	   	}else{
		   	for(i = 0; i < $column.length; i++){
		   		if (typeof(aData[$column[i]])!=null){
					myDate=aData[$column[i]].split("-");
					var newDate=myDate[1]+"/"+myDate[0]+"/"+myDate[2];
					datum = new Date(newDate).getTime();
			   		if(minDateFilter == "" && datum <= maxDateFilter){
		   				return true;
			   		}
			   		else if(maxDateFilter == "" && datum >= minDateFilter){
		   				return true;
			   		}
			   		else if(minDateFilter <= datum && maxDateFilter >= datum){
			   			return true;
			   		}
		   		}
		   	}
		   	return false;
		}
	});
	jQuery.fn.dataTable.render.moment = function ( from, to, locale ) {
		// Argument shifting
		if ( arguments.length === 1 ) {
			locale = 'en';
			to = from;
			from = 'YYYY-MM-DD HH:mm:ss';
		}
		else if ( arguments.length === 2 ) {
			locale = 'en';
		}

		return function ( d, type, row ) {
			var m = window.moment( d, from, locale, true );

			// Order and type get a number value from Moment, everything else
			// sees the rendered value
			return m.format( type === 'sort' || type === 'type' ? 'x' : to );
		};
	};

	$(document).ready(function (){
		var table = $table.DataTable({
			"scrollX": true,
			responsive: true,
			dom: 'B<"clear">lfrtip',
			buttons: [
				'excel',
				{
				extend: 'pdfHtml5',
				orientation: 'landscape',
				columns: ':not(:first-child)',
				pageSize: 'LEGAL'
				},
				'print',
				{
				extend: 'colvis',
        		columns: ':not(:first-child)',
    			}
			],
			columnDefs: [{
				targets: $column,
				render: $.fn.dataTable.render.moment( "YYYY-MM-DD", "DD-MM-YYYY")
			},{
				targets: -2,
				render: $.fn.dataTable.render.moment( "YYYY-MM-DD HH:mm:ss", "DD-MM-YYYY HH:mm:ss")
			}]
		});
		if((typeof $ordering != 'undefined' && $ordering)){
		table.order([$ordering, 'desc']).draw();
		}
	});