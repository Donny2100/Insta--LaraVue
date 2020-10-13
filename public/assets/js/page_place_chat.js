(function ($) {
    'use strict';

    $(document).ready(function () {
        var placeId = 1; // get the place ID from laravel blade template
        var channelId;

        Http.get('/api/chat/place/' + placeId + '/channels', {headers: {authorization: 'Bearer ' + $('#usrtk').val()}}).then(function(response) {
            console.log(response.data); // chat channel (or channels if it is place owner) data

            channelId = response.data.channel.id;

            Echo.join('conversation.' + channelId)
            .here((users) => {
                // who is in the chat right now
                console.log(users);
            })
            .joining((user) => {
                // who just logged in
                console.log(user.name);
            })
            .leaving((user) => {
                // who just logged out
                console.log(user.name);
            })
            .listen('.message.posted', (e) => {
                // messages
                console.log(e);
            });

            Http.get('/api/chat/channel/' + channelId + '/messages', {headers: {authorization: 'Bearer ' + $('#usrtk').val()}})
                .then(function(response) {
                    console.log(response.data);
                });
        });
    });
})(jQuery);
