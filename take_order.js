
$('.checkbox').click(function(){
	var price=0;
		$('.checkbox:checked').each(function(){

			price += parseInt($('#price_'+this.value).val());
			
		}); 


		if(document.getElementById('check_'+this.value).checked)
		{
			$('#view_item_'+this.value).show();
			$('#quantity_'+this.value).focus();
		}
		else
			$('#view_item_'+this.value).hide();

		$('#ttl').html(price);
		$('#ttl_product').html($("[type='checkbox']:checked").length);

		if(price==0)
		{
			document.getElementById('bill_print').disabled = true;
			$('#bill_box').slideUp();
		}
		else
		{
			document.getElementById('bill_print').disabled = false;
			$('#bill_box').slideDown();
		}
		return mainCal();

});


	var ttl = 0;
	function cal(th,id)
	{
		var p = $('#price_'+id).val();
		
		ttl = parseInt(p*th.value);
		$('#ttl_price_'+id).html(ttl);
		return mainCal();
	}


	
	function mainCal()
	{
		var list = $("input[type=checkbox]:checked");
		var finalp = 0;
		for(var i=0; i<list.length; i++)
		{ 
			var rate = $("#price_"+list[i].value).val();
			var qty = $("#quantity_"+list[i].value).val();
			finalp +=(rate*qty);
		}
		$("#ttl").html(finalp+'<i style="margin-right:10px" class="fa fa-rupee pull-right">');
		$("#ttl_price").val(finalp);
	}



	$('#bill_print').click(function(){
		if($('input[name=name]').val()=='' || $('input[name=mobile]').val()=='')
		{
			alert('Please Fill all fields...');
		}
		else
			$('#take_order').submit();


	});


	///item section javaScript//

	function view_brand(brand)
	{
		if(brand!='')
		{
			var x = brand.split(',');

			$.ajax({
				     type:'post',
				     url:'connection.php',
				     data:{'brand_id':x[0],'brand_name':x[1],'status':'view_brand'},
				     success:function(r)
				     {
				     		$('#result').html(r);
				     	
				     }
			});
		}
		else
		$('#result').html('');
	}

	
	function update_item(itemId)
	{
		if($('#price_'+itemId).val()=='')
		{
			alert('Please Enter Price..');
			$('#price_'+itemId).focus();
		}
		else
		{
			var price = $('#price_'+itemId).val();
			location.href="connection.php?status=update_item&itemId="+itemId+"&price="+price;
		}
	}