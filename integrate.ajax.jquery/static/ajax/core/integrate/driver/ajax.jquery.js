

function ajaxCall(iddivdest,ajaxdest,params)
{
	$.ajax({
				async: "true",
				type: "post",
				url: "index.php?chainconnector=ajax&ajax="+ajaxdest,
				data: params, //+"&lang="+lang,
				error: function(errorData) { $("#"+iddivdest).html(errorData); },
				success: function(data) {
							$("#"+iddivdest).html(data);
							$("#"+iddivdest).fadeIn("slow", "linear");
						}
		});
}


