$(function(){
    $('.message').addClass('alert alert-success');
    $('.cart_quantities').keypress(function(event){
        var quantities = $(this).val();
        var product_id = $(this).attr('data-product_id');
        if (event.which === 13) {
            updateCart(product_id, quantities);
        }
    });
});

function updateCart(product_id, quantities) {
   var url = 'edit';
   $.ajax({
        type: 'POST',
        url: url,
        data: {
            product_id: product_id,
            quantities: quantities
        }
   }).success(function(msg){
       var test = $.parseJSON(msg);
        console.log(test);
        $('.total_price').hide();
        $('.price').append("<span class='total_price'>"+test+"</span>");
        alert('Update success!');
   }).fail(function() {
        alert('Update fail. Please try again!');
   });
}
