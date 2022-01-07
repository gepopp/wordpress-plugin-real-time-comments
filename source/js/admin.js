(function ($){


    $(function (){
        // wp class no namespace
        $('.color-picker').wpColorPicker();
    })

    var active = 'main';

    function setActive(target){

        $('.rtc-tab').each(function (index, element){
            if($(element).data('tab') == target){
                $(element).show();
            }else{
                $(element).hide();
            }
        });

        $('.rtc-tab-button').each(function (index, element){
            $(element).removeClass('rtc-border-b-2 rtc-border-plugin rtc-border-plugin rtc-font-bold');
        });
        $('#' + target).addClass('rtc-border-b-2 rtc-border-plugin rtc-border-plugin rtc-font-bold')
    }

    setActive(active);

    $('.rtc-tab-button').on('click', function (event){

       setActive( $(event.target).attr('id'));


    });

})(jQuery)