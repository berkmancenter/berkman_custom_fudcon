$.ajax({
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
