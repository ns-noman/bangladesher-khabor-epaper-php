function eploding(obj){
	obj.addClass('logdding');
}
function remove_eploding(obj){
	obj.removeClass('logdding');
}
function clear_nav(){
	$('#accordion-nav a').removeClass('active');
}
function active_nav(obj){
	obj.addClass('active');
}
function set_page_title(){
	var ptitle=$('#page_title h1').text();
	$('title').text(ptitle);
}
function show_massage(msg,mtype){
	$('#status').addClass(mtype).text(msg).show('blind',500,show_massage_callback);
	//setTimeout(function(){$('#status').slideDown('slow').removeClass(mtype).text('');},1000);
}
function show_massage_callback(){
	setTimeout(function() {
        $('#status').hide('blind',500,function(){$(this).attr('class','');}).text('');		
      }, 3000 );
}