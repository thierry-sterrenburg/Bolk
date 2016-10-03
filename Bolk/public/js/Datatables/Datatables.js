		// Datatable script
        //linked datetimepicker

    		$(function () {
		        $('#startdatesearch').datetimepicker({
		        	format: 'DD/MM/YYYY'
		        });
		        $('#enddatesearch').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            format: 'DD/MM/YYYY'
		        });
		        $("#startdatesearch").on("dp.change", function (e) {
		            $('#enddatesearch').data("DateTimePicker").minDate(e.date);
		            minDateFilter = new Date(e.date).getTime();
		           $('#componenttable').DataTable().draw();
		        });
		        $("#enddatesearch").on("dp.change", function (e) {
		            //$('#startdatesearch').data("DateTimePicker").maxDate(e.date);
		            maxDateFilter = new Date(e.date).getTime();
		           $('#componenttable').DataTable().draw();
	        	});
	    	});
    		//DataTables search execution
	    	minDateFilter="";
			maxDateFilter="";
			$.fn.dataTable.ext.search.push(
			   function(oSettings, aData, iDataIndex) {

				if ((typeof aData._date == 'undefined')||(typeof bData == 'undefined')||(typeof cData == 'undefined')) {
			      aData._date = new Date(aData[9]).getTime();
			      var bData = new Date(aData[10]).getTime();
			      var cData = new Date(aData[11]).getTime();
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




			  );

	   		$(document).ready(function () {
	   			//alert(document.getElementById($table)+$('#componenttable'));
				$table.DataTable({
					responsive: true,
					dom: 'Bfrtip',
					buttons: [
						'excel', 'pdf', 'print'
					]
				});
			} );