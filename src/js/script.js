$(function(){
    var wrapper_childs = [$(".reg"), $(".auth"), $(".profile"), $(".cart")];
    var wrapper = $("#wrapper");
    $("#tel").mask('+7 (999) 999-99-99');
    wrapper.hide();
    $(".notification").hide();

    function hideWrapChilds(){
        wrapper_childs.forEach(e => {
            e.hide();
        });
    }

    hideWrapChilds();

    $("#profile").on("click", function(){
        // Открытие профиля по нажатию пункта меню
        if(wrapper_childs[2].length == 0){
            $(".auth").show();
        }
        else{
            $(".profile").show();
        }
        wrapper.show(500);
    });

    $(".wrapper__header img").on("click", function(){
        // Закрытие менюшек, появляющихся на переднем плане, при нажатии на крест
        wrapper.hide(500);
        hideWrapChilds();
    });

    $(".busket__button").on("click", function(){
        // Открытие корзины
        $(".cart").show();
        wrapper.show(500);
    });

    $(".switch__form").on("click", function(){
        // Смена окна регистрации на окно авторизации и наоборот при нажатии на кнопку
        $(".reg").toggle();
        $(".auth").toggle();
    });

    $("#get_promocode").on("click", function(){
        // Копирование промокода при нажатии на кнопку
        var $tmp = $("<input>");
        $("body").append($tmp);
        $tmp.val("FIFTYCENT").select();
        document.execCommand("copy");
        $tmp.remove();
        notification(1, "Промокод скопирован в Буфер обмена")
    })

    function notification(type, description){
        // Уведомление
        let header, color;
        switch(type){
            case 0:
                header = "Информация";
                color = "#4084c4";
                break;
            case 1:
                header = "Успешно";
                color = "#40c46c";
                break;
            case 2:
                header = "Ошибка";
                color = "#c44040";
                break;

        }
        $(".notification").css("border-color", color);
        $("#not__header")[0].innerHTML = header;
        $("#not__desc")[0].innerHTML = description;
        $(".notification").show(500).delay(3000).hide(500);
    };

    $('.reg button').on("click", function(e){
        e.preventDefault();
        let email = $('input[name="email"]').val(),
            password = $('input[name="password1"]').val(),
            password_confirm = $('input[name="password2"]').val(),
            telephone = $('input[name="telephone"]').val(),
            name = $('input[name="username"]').val(),
            fields = [
                $('input[name="email"]'),
                $('input[name="password1"]'),
                $('input[name="password2"]'),
                $('input[name="telephone"]'),
                $('input[name="username"]')
            ];
        $.ajax({
            url: '../../core/signup.php',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email,
                password: password,
                password_confirm: password_confirm,
                telephone: telephone,
                name: name
            },
            success (data) {
                if (data.status) {
                    document.location.href = '../../index.php';
                } 
                else {
                    fields.forEach(function (field) {
                        field.attr('style', '');
                    });
                    if (data.type === 1) {
                        data.fields.forEach(function (field) {
                            $(`input[name="${field}"]`).css("border-color", "#c44040");
                        });
                    }
                    notification(2, data.message);
                }
            }
        });
    });

    $('.auth button').on("click", function(e){
        e.preventDefault();
        let email = $('input[name="email_login"]').val(),
            password = $('input[name="password_login"]').val(),
            fields = [
                $('input[name="email_login"]'),
                $('input[name="password_login"]')
            ];
        $.ajax({
            url: '../../core/signin.php',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email,
                password: password
            },
            success (data) {
                if (data.status) {
                    document.location.href = '../../index.php';
                } 
                else {
                    fields.forEach(function (field) {
                        field.attr('style', '');
                    });
                    if (data.type === 1) {
                        data.fields.forEach(function (field) {
                            $(`input[name="${field}"]`).css("border-color", "#c44040");
                        });
                    }
                    notification(2, data.message);
                }
            }
        });
    });

    $('#category').on("change", function(e){
        var section_id = $(e.target).val(),
            items = $(".catalog__item");
        console.log(section_id);    
        function showAllItems(){
            for(let i = 0; i < items.length; i++){
                $(items[i]).show();
            }
        }    
        function hideAllItems(){
            for(let i = 0; i < items.length; i++){
                $(items[i]).hide();
            }
        }    
        hideAllItems();
        if (section_id == 0){
            showAllItems();
        }
        else{
            for(let i = 0; i < items.length; i++){
                if(parseInt($(items[i].children[4]).val().trim()) == parseInt(section_id.trim())){
                    $(items[i]).show();
                    console.log(1111111);
                }
            }
        }
        
    });


})