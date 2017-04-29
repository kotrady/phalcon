/**
 * Created by Jakub on 15.02.17.
 */

$(function(){

    var inputFocus = $('div.effect-input-label input.input-focus');
    if(inputFocus.length){
        inputFocus.on('focus', function(){
           var self = $(this);
           self.parents('div.form-group').addClass('input-focused');
        });
        inputFocus.on('focusout', function(){
            var self = $(this);
            var value = $.trim(self.val());
            if(value == "") self.parents('div.form-group').removeClass('input-focused');
        });
    }

});