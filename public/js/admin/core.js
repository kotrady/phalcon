/**
 * Created by Jakub on 15.02.17.
 */

$(function () {

    var centerBox = $('[data-center="c"]');
    if (centerBox.length) {
        centerBox.centerBox();
    }

    var centerV = $('[data-center="v"]');
    if (centerV.length) {
        centerV.centerV();
    }

    var centerH = $('[data-center="h"]');
    if (centerH.length) {
        centerH.centerH();
    }

    var formLoader = $('form.form-loader');
    if (formLoader.length) {
        formLoader.on('submit', function (e) {
            var self = $(this);
            self.addClass('form-loading');
        });
    }

    var buttonLoader = $('.btn.btn-loader');
    if (buttonLoader.length) {
        buttonLoader.on('click', function (e) {

            var self = $(this);
            var form = self.parents('form');

            if (form.isValid()) {

                var height = self.height();
                var value = self.text();
                var button = self.children('.btn[type="submit"]');

                self.height(height);
                self.text("");
                self.addClass('btn-loading');
            }
        });
    }

    var flashMessagesWrap = $('#flashMessagesWrap');
    var flashMessage = $('div.flash-message');
    if(flashMessage.length){

        var closeFlashMessage = flashMessage.find('div.flash-message-close');
        closeFlashMessage.on('click', function(){
            $(this).parent(flashMessage).fadeOut(200, function(){
                this.remove();
                var flashMessage = $('div.flash-message');
                if(!flashMessage.length){
                    flashMessagesWrap.remove();
                }
            });
        });

    }

});

function addFlashMessage(type,title,text){
    var flashMessagesWrap = $('#flashMessagesWrap');
    if(!flashMessagesWrap.length) {
        flashMessagesWrap = $('<div></div>').attr('id', 'flashMessagesWrap').appendTo($('body')).show();
    }

    var flashMessages = $('<div></div>').attr('class', 'flash-message').appendTo(flashMessagesWrap);
    flashMessages.append('<div class="flash-message-title ' + type + '">' + title + '</div><div class="flash-message-text">' + text + '</div>');
    flashMessages.fadeIn();
};

jQuery.fn.isValid = function () {

    var self = this;
    var valid = true;
    var requiredInputs = self.find('input[required="required"]');
    if (requiredInputs.length) {
        requiredInputs.each(function () {
            var input = $(this);
            var value = $.trim(input.val());
            if (value == "") {
                valid = false;
            }
        });
    }

    return valid;

}

jQuery.fn.centerBox = function () {

    var width = this.width();
    var height = this.height();

    this.css({
        'top': '50%',
        'left': '50%',
        'marginLeft': '-' + width / 2 + 'px',
        'marginTop': '-' + height / 2 + 'px',
        'opacity': 1
    });

    return this;

}

jQuery.fn.centerV = function () {

    var height = this.height();

    this.css({
        'top': '50%',
        'marginTop': '-' + height / 2 + 'px',
        'opacity': 1
    });

    return this;

}

jQuery.fn.centerH = function () {

    var width = this.width();

    this.css({
        'left': '50%',
        'marginLeft': '-' + width / 2 + 'px',
        'opacity': 1
    });

    return this;

}