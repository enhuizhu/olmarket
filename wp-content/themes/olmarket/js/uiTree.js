/**
* jQuery plugin for UI tree
**/
jQuery.fn.uiTree = function(config){
	var that = this;
	/**
	* add event listener to the operator
	**/
	this.find(".operator").bind("click",function(){
		jQuery(this).parent().parent(".ui-tree").toggleClass("expand");
	});
}