		// Datatable script
        //linked datetimepicker

    		$(function () {
    			if(typeof $column2 != 'undefined'){
    				$('#startdatesearch2').datetimepicker({
		        	format: 'YYYY-MM-DD'
		        });
		        $('#enddatesearch2').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            format: 'YYYY-MM-DD'
		        });
		        $("#startdatesearch2").on("dp.change", function (e) {
		            $('#enddatesearch2').data("DateTimePicker").minDate(e.date);
		            minDateFilter = new Date(e.date).getTime();
		           $table2.DataTable().draw();
		        });
		        $("#enddatesearch2").on("dp.change", function (e) {
		            //$('#startdatesearch').data("DateTimePicker").maxDate(e.date);
		            maxDateFilter = new Date(e.date).getTime();
		           $table2.DataTable().draw();
	        	});
		    	}
		        $('#startdatesearch').datetimepicker({
		        	format: 'YYYY-MM-DD'
		        });
		        $('#enddatesearch').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            format: 'YYYY-MM-DD'
		        });
		        $("#startdatesearch").on("dp.change", function (e) {
		            $('#enddatesearch').data("DateTimePicker").minDate(e.date);
		            minDateFilter = new Date(e.date).getTime();
		           $table.DataTable().draw();
		        });
		        $("#enddatesearch").on("dp.change", function (e) {
		            //$('#startdatesearch').data("DateTimePicker").maxDate(e.date);
		            maxDateFilter = new Date(e.date).getTime();
		           $table.DataTable().draw();
	        	});
	    	});
    		//DataTables search execution
	    	minDateFilter="";
			maxDateFilter="";
			$.fn.dataTable.ext.search.push(
			   function(oSettings, aData, iDataIndex) {
			   	if($column.length == 2){
					if ((typeof aData._date == 'undefined')||(typeof bData == 'undefined')) {
				      aData._date = new Date(aData[$column[0]]).getTime();
				      var bData = new Date(aData[$column[1]]).getTime();
				    }

				    if (minDateFilter && !isNaN(minDateFilter)) {
				      if ((aData._date < minDateFilter)&&(bData < minDateFilter)) {
				        return false;
				      }
				    }

				    if (maxDateFilter && !isNaN(maxDateFilter)) {
				      if ((aData._date > maxDateFilter)&&(bData > maxDateFilter)) {
				        return false;
				      }
				    }

				    return true;

			   	} else if($column.length == 3){
					if ((typeof aData._date == 'undefined')||(typeof bData == 'undefined')||(typeof cData == 'undefined')) {
				      aData._date = new Date(aData[$column[0]]).getTime();
				      var bData = new Date(aData[$column[1]]).getTime();
				      var cData = new Date(aData[$column[2]]).getTime();
				    }

				    if (minDateFilter && !isNaN(minDateFilter)) {
				      if ((aData._date < minDateFilter)&&(bData < minDateFilter)&&(cData < minDateFilter)) {
				        return false;
				      }
				    }

				    if (maxDateFilter && !isNaN(maxDateFilter)) {
				      if ((aData._date > maxDateFilter)&&(bData > maxDateFilter)&&(cData > maxDateFilter)) {
				        return false;
				      }
				    }

			    return true;
			  }
			});

	   		$(document).ready(function () {
	   			if (typeof $table2 != 'undefined'){
	   				$table2.DataTable({
					responsive: true,
					dom: 'Bfrtip',
					buttons: [
						'excel', 'pdf', 'print'
					]
				});
	   			}
				$table.DataTable({
					responsive: true,
					dom: 'Bfrtip',
					buttons: [
						'excel', 'pdf', 'print'
					]
				});
			});