// Datatable script
//linked datetimepicker
	var $searchcolumn= $column;
	$(function () {
		if(typeof $column2 != 'undefined'){
			$('#startdatesearch2').datetimepicker({
        	sideBySide: true,
			format: 'DD-MM-YYYY',
			calendarWeeks: true
        });
        $('#enddatesearch2').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            sideBySide: true,
			format: 'DD-MM-YYYY',
			calendarWeeks: true
        });
        $("#startdatesearch2").on("dp.change", function (e) {
            $('#enddatesearch2').data("DateTimePicker").minDate(e.date);
            minDateFilter = new Date(e.date).getTime();
           $table2.DataTable().draw();
           $searchcolumn = $column2;
        });
        $("#enddatesearch2").on("dp.change", function (e) {
            //$('#startdatesearch').data("DateTimePicker").maxDate(e.date);
            maxDateFilter = new Date(e.date).getTime();
           $table2.DataTable().draw();
           $searchcolumn = $column2;
    	});
    	}
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
            minDateFilter = new Date(e.date).getTime();
           $table.DataTable().draw();
           $searchcolumn = $column;
        });
        $("#enddatesearch").on("dp.change", function (e) {
            //$('#startdatesearch').data("DateTimePicker").maxDate(e.date);
            maxDateFilter = new Date(e.date).getTime();
           $table.DataTable().draw();
           $searchcolumn = $column;
    	});
	});
	//DataTables search execution
	minDateFilter="";
	maxDateFilter="";
	// $.fn.dataTable.ext.search.push(
	//    function(oSettings, aData, iDataIndex) {

	//    	if($searchcolumn.length == 2){
	// 		if ((typeof aData._date == 'undefined')||(typeof bData == 'undefined')) {
	// 	      aData._date = new Date(aData[$searchcolumn[0]]).getTime();
	// 	      var bData = new Date(aData[$searchcolumn[1]]).getTime();
	// 	    }

	// 	    if (minDateFilter && !isNaN(minDateFilter)) {
	// 	      if ((aData._date < minDateFilter)&&(bData < minDateFilter)) {
	// 	        return false;
	// 	      }
	// 	    }

	// 	    if (maxDateFilter && !isNaN(maxDateFilter)) {
	// 	      if ((aData._date > maxDateFilter)&&(bData > maxDateFilter)) {
	// 	        return false;
	// 	      }
	// 	    }

	// 	    return true;

	//    	} else if($searchcolumn.length == 3){
	// 		if ((typeof aData._date == 'undefined')||(typeof bData == 'undefined')||(typeof cData == 'undefined')) {
	// 	      aData._date = new Date(aData[$searchcolumn[0]]).getTime();
	// 	      var bData = new Date(aData[$searchcolumn[1]]).getTime();
	// 	      var cData = new Date(aData[$searchcolumn[2]]).getTime();
	// 	    }

	// 	    if (minDateFilter && !isNaN(minDateFilter)) {
	// 	      if ((aData._date < minDateFilter)&&(bData < minDateFilter)&&(cData < minDateFilter)) {
	// 	        return false;
	// 	      }
	// 	    }

	// 	    if (maxDateFilter && !isNaN(maxDateFilter)) {
	// 	      if ((aData._date > maxDateFilter)&&(bData > maxDateFilter)&&(cData > maxDateFilter)) {
	// 	        return false;
	// 	      }
	// 	    }

	//     return true;
	//   }
	// });
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

		$(document).ready(function () {
		$table.DataTable({
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
				render: $.fn.dataTable.render.moment( "DD-MM-YYYY")
			}]
		});
		if (typeof $table2 != 'undefined'){
				$table2.DataTable({
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
			]
		});
			}
	});