(function() {
	"use strict";

	// change total amount on amount change
	$('input[name=TxtPrice]:text').on("input",function(e)
	{
		$('#order_total').html((Math.ceil($('input[name=TxtPrice]:text').val())));
		return false;
	});

	// change value if customer select and product
	$('#products').on('change', function() {
		var id = $('option:selected', this).attr('value');

		if (id > -1){
			var amount = $('option:selected', this).attr('amount');
			var desc = $('option:selected', this).attr('desc');
			$('#order_total').html((Math.ceil(amount)));
			$('input[name=TxtPrice]:text').hide();
			$('textarea[name=TxtTitle]').val('کد محصول :' + id + ' | قیمت ' + amount + '\n توضیحات :' + desc)
		}else {
			$('#order_total').html((Math.ceil($('input[name=TxtPrice]:text').val())));
			$('input[name=TxtPrice]:text').show();
			$('textarea[name=TxtTitle]').val('');
		}

	});

	// on click order button submit the form
	$('#order_btn_id').on("click",function(e)
	{
		e.preventDefault();
		$('#order_frm').submit();
	});
	// on click order button of basic form then submit the order form
	$('#order_btn_id2').on("click",function(e) {
		e.preventDefault();
		// change the action of the basic form to thankyou.php
		$('#order_frm').get(0).setAttribute('action', 'order.php'); //change the action on submit
		$('#order_frm').submit();
	});
	$('input:text, textarea').keyup(function(e) {
		$('#error_order').css('display','none');
	});
	$('#order_frm').submit(function(e)
	{
		if ($('#products').val() == -1 ){
			if($('input[name=TxtPrice]:text').val()=='' || $('input[name=TxtPrice]:text').val()=='0')
			{
				$('#error_order').css('display','block').html('لطفا مبلغ معتبر قابل قبول واردنمایید');
				$('input[name=TxtPrice]:text').focus();
				return false;
			}
		}
		if($('input[name=TxtName]:text').val()=='')
		{
			$('#error_order').css('display','block').html('لطفا نام و نام خانوادگی خود را وارد کنید');
			$('input[name=TxtName]:text').focus();
			return false;
		}
		else if($('input[name=TxtEmail]:text').val()=='')
		{
			$('#error_order').css('display','block').html('لطفا ایمیل خود را وارد کنید');
			$('input[name=TxtEmail]:text').focus();
			return false;
		}
		else if($('textarea[name=TxtTitle]').val()=='')
		{
			$('#error_order').css('display','block').html('لطفا توضیحی در رابطه با خرید وارد کنید');
			$('textarea[name=TxtTitle]').focus();
			return false;
		}
		else
		{
			return true;
		}
	});
	function validate_email(email)
	{
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		return reg.test(email);
	}

})(jQuery);
