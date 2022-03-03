var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);
$(".menu1").next('ul').toggle();

$(".menu1").click(function(event) {
	$(this).next("ul").toggle(500);
});
$('#dataTables-example').DataTable({
	responsive: true,
	"autoWidth": false,
});
$('#select_brand').change(function(){
	var id_brand = $(this).val();
	$.ajax({
		type: 'GET',
		url: location.origin + '/MyProjectLaravel/public/admin/ajax/brand/'+id_brand,
		success: function(data){
			$('#select_model').html(data);
		},
		error: function(xhr,status,error){
			alert('No data from this brand');
			$('#select_model').html("<option value=''>--Choose Model--</option>");
		},
		dataType: 'text'
	});
});
$('#name_user').on('click',function(){
	
	$('#information_user').slideToggle(2000);
});
$('#input_txtName').hide();
$('#label_name').on('click',function(){
	$('#input_txtName').toggle(2000);
});
$('#input_txtAddress').hide();
$('#label_address').on('click',function(){
	$('#input_txtAddress').toggle(2000);
});
$('#input_txtPhone').hide();
$('#label_phone').on('click',function(){
	$('#input_txtPhone').toggle(2000);
});
$('.select_birthday').hide();
$('#label_birthday').on('click',function(){
	$('.select_birthday').toggle(2000);
});
