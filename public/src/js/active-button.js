$(document).on('click', 'button', function(){
    $(this).addClass('active').siblings().removeClass('active');
})