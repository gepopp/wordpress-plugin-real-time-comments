(function ($){


    $(function (){
        $('.color-picker').wpColorPicker();
    })

    var active = 'main';

    function setActive(target){
        $('.tab').each(function (index, element){
            if($(element).data('tab') == target){
                $(element).show();
            }else{
                $(element).hide();
            }
        });
        $('.tab-button').each(function (index, element){
            $(element).removeClass('border-b-2 border-plugin border-plugin font-bold');
        });
        $('#' + target).addClass('border-b-2 border-plugin border-plugin font-bold')
    }

    setActive(active);

    $('.tab-button').on('click', function (event){
       setActive( $(event.target).attr('id'));


    });

})(jQuery)