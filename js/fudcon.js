$(function() {
    /*$.ajax({
        url: 'participants/',
        dataType: 'html',
        success: function(data) {
            var htmlToInsert = '';
            $('.entry-content img', data).each(function(i, image) {
                htmlToInsert += '<li>' + $(image).clone().wrap('<div/>').parent().html() + '<span class="participant-name">' + $(image).attr('alt').replace(', ','<br />') + '</span></li>';
            });
            $('#participants ul').html(htmlToInsert);
        },
        error: function(jqXHR) {
            alert('Error');
        }
    });

    $.ajax({
        url: 'agenda/',
        dataType: 'html',
        success: function(data) {
            $('.entry-content', data).insertAfter('#agenda > header');
        },
        error: function(jqXHR) {
            alert('Error');
        }
    });

    $.ajax({
        url: 'about/',
        dataType: 'html',
        success: function(data) {
            $('.entry-content', data).insertAfter('#about > header');
        },
        error: function(jqXHR) {
            alert('Error');
        }
    });

    $.ajax({
        url: 'blog/',
        dataType: 'html',
        success: function(data) {
            $('#content > *', data).insertAfter('#updates > header');
            /*$('#updates').cycle({
                slideExpr: 'article',
                fx: 'scrollUp'
            });
        },
        error: function(jqXHR) {
            alert('Error');
        }
    });

    $('#tweets').cycle({
        fx: 'scrollUp'
    });*/
    /*$('article').parent().cycle({
        slideExpr: 'article',
        fx: 'slideUp'
    });*/
});
