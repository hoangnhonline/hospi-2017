$(function(){
 

  $(".makeDefault").on('click',function(){
  var id = $(this).attr('id');
  var baseurl =  $(this).data('url');
  var answer = confirm("Bạn có chắc chắn chọn mục này là Mặc định?");
  if (answer){
     $.post(baseurl, { id: id }, function(theResponse){
          location.reload();
			});
  }

  });

  $(".fstar").on('click',function(){
  var id = $(this).prop('id');
  var url = $(this).data('url');
  var ft = $(this).data('featured');
  var thisStar = $(this);
  
   $.post(url, { isfeatured: ft, id: id }, function(theResponse){ 
    if(theResponse == "done"){

      if(ft == "no"){
     thisStar.removeClass('fa-star');
     thisStar.addClass('fa-star-o');
     thisStar.data('featured',"yes");
  }else{
     thisStar.removeClass('fa-star-o');
     thisStar.addClass('fa-star');
     thisStar.data('featured',"no");
  }

  showNotify();
    }

    });
  
 })



})

 function updateOrder(order,id,olderval){
   var url = $("#order_"+id).data('url');   

    if(order != olderval){
     $.post(url, { order: order,id: id }, function(theResponse){
        if(theResponse == '1'){
            showNotify();
        }else{
        alert('Invalid Order');
        $("#order_"+id).val(olderval);
   }

  	});
  }


  }

  function showNotify(){
     new PNotify({
                      title: 'Changes Saved!',
                      type: 'info',
                      animation: 'fade'
                      });
  }

  function getReviewScore(score){

var sum = 0;
var avg = 0;

$('option:selected').each(function() {
  val = $(this).val(); console.log(val);
  if(val != "No" && val != "Yes"){
sum += parseInt(val);

  }
 //console.log(sum);
});
avg = sum/5;

$("#overall").val(avg);
  }

function delfunc(id,baseurl){

  var answer = confirm("Bạn chắc chắn muốn xóa?");
  if (answer){
     $.post(baseurl, { id: id }, function(theResponse){
                 location.reload();
      });

  }else{
    location.reload();
     return false;
  }
 
  
  }


function multiDelfunc(url,chkclass){
var checkedValues = $('.'+chkclass+':checked').map(function() {
    return this.value;
}).get();

if(checkedValues.length < 1){
  alert("Vui lòng chọn ít nhất 1 mục.");

}else{

   var answer = confirm("Bạn chắc chắn muốn xóa?");
   if (answer){
     $.post(url, { items: checkedValues }, function(theResponse){
      window.location = window.location.href;
      });

  }else{

    window.location = window.location.href;
     return false;
  }
  
}

 
}


function approvefunc(id,baseurl){

  var answer = confirm("Bạn chắc chắn thực hiện thao tác này?");
  if (answer){
     $.post(baseurl, { id: id }, function(theResponse){
                 location.reload();
      });

  }else{
    location.reload();
    return false;
  }
  
  
  }

  function hideBooking(id,baseurl){ 

     $.post(baseurl, { id: id }, function(theResponse){
               
      });
     $("#"+id).fadeOut("slow");

  
  }