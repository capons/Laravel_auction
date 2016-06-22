var main = (function () {
    doConstruct = function () {
        this.init_callbacks = [];
    };
    doConstruct.prototype = {
        add_init_callback : function (func) {
            if (typeof(func) == 'function') {
                this.init_callbacks.push(func);
                return true;
            }
            else {
                return false;
            }
        }
    };
    return new doConstruct;
})();
$(document).ready(function () {
    $.each(main.init_callbacks, function (index, func) {
        func();
    });
});
var admin_users = (function () {
    var doConstruct = function () {
        main.add_init_callback(this.registration_checkbox);
    };
    doConstruct.prototype = {
        registration_checkbox: function () { //only one checkbox is checked
            $("input:checkbox").on('click', function() {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method
                    // as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change
                    // and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                } else {
                    $box.prop("checked", false);
                }
            });
        },
    };
    return new doConstruct;
})();

//js for routes /promise/sell
var promise_sell = (function () {
    var doConstruct = function () {
        main.add_init_callback(this.upload_file_promise);
        main.add_init_callback(this.sell_promise_form_type);
    };
    doConstruct.prototype = {
        upload_file_promise: function (){
            $('#p_up_photo').click(function(){
                $('#upfile').click(); //upload file input click
            });
            /*
             $("#upfile").change(function() {
             var files = $(this)[0].files;
             for (var i = 0; i < files.length; i++) {
             if((i + 1) !== files.length) {          //If the last cell in the array - the name of the output append without ','
             $("#btn").append(files[i].name+',  ');
             } else {
             $("#btn").append(files[i].name);
             }
             }
             });
             */
        },
        sell_promise_form_type: function (){
            $('#btn_buy').click( function () {  //click if promise for sale
                var p_type = 0;
                $('input[name="sell_promise_type"]').val(p_type); //indicate wich type of sell cheked
                $('#btn_buy').toggleClass('buy_promis_active');
                if($("#btn_auction" ).hasClass( "buy_promis_active" )) {
                    $('#btn_auction').toggleClass('buy_promis_active');
                    $('.promise_auction').hide(); //hide auction promise input
                    $('#promise_f_buy').show(); // show sell promise input
                }

            });
            $('#btn_auction').click(function () { //click if promise auction
                var p_type = 1;
                $('input[name="sell_promise_type"]').val(p_type); //indicate wich type of sell cheked
                $('#btn_auction').toggleClass('buy_promis_active');
                $('#promise_f_buy').hide(); // hide sell promise input
                $('.promise_auction').show(); //show auction input

                if($("#btn_buy" ).hasClass( "buy_promis_active" )) {
                    $('#btn_buy').toggleClass('buy_promis_active');
                }

            });
        },
    };
    return new doConstruct;
})();
