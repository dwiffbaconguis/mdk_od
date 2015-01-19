$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
    	var from;
    	var to;
    	var date_column = new Date(data[0]);
    	if($("#from").val() != "" && $("#to").val() != ""){
    		from = new Date($("#from").val());
    		to = new Date($("#to").val());
	    	if(from <= date_column && to >= date_column){
	    		return true;
	    	}
	        return false;
    	} else if($("#from").val() != ""){
    		from = new Date($("#from").val());
    		if(from <= date_column){
	    		return true;
	    	}
	        return false;
    	} else if($("#to").val() != ""){
    		to = new Date($("#to").val());
    		if(to >= date_column){
	    		return true;
	    	}
	        return false;
    	}
    	return true;
    }
);

$(document).ready(function(){
	var table = $('#report-list').DataTable({
      "scrollY": "400px",
      "scrollCollapse": true,
      "paging": false,
      "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sRowSelect": "multi",
            "sSwfPath": "assets/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
                "print",
                  {'sExtends':'xls',
                   "oSelectorOpts": { filter: 'applied', order: 'current' },
                  },
                  {'sExtends':'pdf',
                   "oSelectorOpts": { filter: 'applied', order: 'current' },
                  }
            ]
        },
 		   "footerCallback": function ( row, data, start, end, display ) {
          var api = this.api(), data;

          // Remove the formatting to get integer data for summation
          var intVal = function ( i ) {
              return typeof i === 'string' ?
                  i.replace(/[\$,]/g, '')*1 :
                  typeof i === 'number' ?
                      i : 0;
          };

          // Total over all pages
          total = api
              .column( 3 )
              .data()
              .reduce( function (a, b) {
                  return intVal(a) + intVal(b);
              } );

          // Total over this page
          pageTotal = api
              .column( 3, { page: 'current'} )
              .data()
              .reduce( function (a, b) {
                  return intVal(a) + intVal(b);
              }, 0 );

          // Update footer
          $( api.column( 3 ).footer() ).html(
              'P'+pageTotal
          );
      }
  });

    $( "#from" ).datepicker({
      defaultDate: "+1w",
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });

    $("#from, #to").change(function(){
      table.draw();
    });
});

