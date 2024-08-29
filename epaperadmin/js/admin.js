jQuery(document).ready(function ($) {
	set_page_title();
	$("#accordion-nav").accordion({ heightStyle: "content", header: 'h3' });
	$('#status').on('hover', function () { $(this).fadeOut('slow'); });

	$("#accordion-nav a").on('click', function () {
		clear_nav();
		active_nav($(this));
		var page_req = $(this).attr('href');
		load_ajax_page(page_req);
		return false;
	})

	$('#page_title .page').on('hover', function () { })
});
function load_ajax_page(page_req) {
	var page_loder = $('#content');
	var ajaxuri = "adminAjax.php";
	eploding(page_loder);
	$.ajax({
		url: ajaxuri,
		data: { page: page_req },
		type: 'POST',
		success: function (responce) {
			$('#ajax-container').html(responce);
			remove_eploding(page_loder);
		}
	});

}
