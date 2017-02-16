/**
 * Created by Jakub on 15.02.17.
 */
$(function(){
    addFlashMessage('ERROR', 'TITLE', 'TEXT');
    addFlashMessage('ERROR2', 'TITLE2', 'TEXT2');

});

function addFlashMessage(type,title,text){
    var flashMessagesWrap = $('#flashMessagesWrap');
    if(!flashMessagesWrap.length) {
        flashMessagesWrap = $('<div></div>').attr('id', 'flashMessagesWrap').appendTo($('body')).show();
    }

    var flashMessages = $('<div></div>').attr('class', 'flash-message').appendTo(flashMessagesWrap);
    flashMessages.append('<div class="flash-message-title ' + type + '">' + title + '</div><div class="flash-message-text">' + text + '</div>').centerBox();
    flashMessages.fadeIn();
};

jQuery.fn.centerBox = function() {

    var width = this.width();
    var height = this.height();

    this.css({
        'top': '50%',
        'left': '50%',
        'marginLeft': '-' + width / 2 + 'px',
        'marginTop': '-' + height / 2 + 'px',
    });

    return this;

}