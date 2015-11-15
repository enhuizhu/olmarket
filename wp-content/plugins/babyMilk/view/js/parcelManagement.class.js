/**
* a js class to manage the parcel
**/

var parcelManagement={
	bindEvents : function(){
		jQuery("[data-parcelId]").click(function(){
			/**
			* get parcel id
			**/

			var that = this,
				parent = jQuery(this).parent().parent(),
				parcelId = jQuery(this).attr("data-parcelId"),
				parcleDate = parent.find("[data-date]").html(),
				price = parent.find("[data-price]").html(),
				cost = parent.find("[data-cost]").html(),
				note = parent.find("[data-note]").html();

    		var data="action=updateParcel&parcelId="+parcelId;
				data+="&p_date="+parcleDate;
				data+="&price="+price;
				data+="&cost="+cost;
				data+="&note="+note;

			// console.log("the value of parcelId is:", parcelId, parcleDate, price, cost, note);
			// return false;

	        jQuery.ajax({
			     url:adminAjax,
				 data:data,
				 type:"post",
				 beforeSend:function(xhr){
				    jQuery(that).html("sending...");
				 },
				 success:function(data){
				    console.log(data);
					var response=JSON.parse(data);
					if(response.error){
					    alert(response.message);
						return false;
					}
					
				    /**
					* delete the whole tr dom
					**/
				    jQuery(that).html("update");
				    location.reload();
				    // return true;
				 }
			  });




		});
	},	
}

parcelManagement.bindEvents();



