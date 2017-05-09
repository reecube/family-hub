(function () {
    'use strict';

    if (!location || !location.search || !location.pathname || !history || !history.pushState) {
        return;
    }

    var parseQuery = function (qstr) {
        var query = {};
        var a = (qstr[0] === '?' ? qstr.substr(1) : qstr).split('&');
        for (var i = 0; i < a.length; i++) {
            var b = a[i].split('=');
            query[decodeURIComponent(b[0])] = decodeURIComponent(b[1] || '');
        }
        return query;
    };

    var stringifyQuery = function (query) {
        if (!query || !query.length) {
            return '';
        }

        var qstr = '?';

        for (var i in query) {
            if (query.hasOwnProperty(i)) {
                qstr += encodeURIComponent(i) + '=' + encodeURIComponent(query[i]);
            }
        }

        return qstr;
    };

    var deleteMessagesAndErrors = function (query) {
        if (query.messages) delete query.messages;
        if (query.message) delete query.message;
        if (query.errors) delete query.errors;
        if (query.error) delete query.error;

        return query;
    };

    var query = deleteMessagesAndErrors(parseQuery(location.search));
    var queryString = stringifyQuery(query);

    return history.pushState(null, '', location.pathname + queryString);
})();