$(function () {
  'use strict';

  // Declare constants
  var CLASS_COLOR_PRIMARY = 'mdl-color--primary';
  var SELECTOR_CALENDAR = '.js-calendar';
  var SELECTOR_CALENDAR_LINK = '.js-calendar-link';

  // Declare variables
  var $document = $(document);

  // Declare events
  var onCalendarLinkAction = function (event) {
    var self = this;
    var $self = $(self);

    var $calendar = $self.closest(SELECTOR_CALENDAR);
    var $calendarLinks = $calendar.find(SELECTOR_CALENDAR_LINK);

    $calendarLinks.removeClass(CLASS_COLOR_PRIMARY);
    $self.addClass(CLASS_COLOR_PRIMARY);

    event.preventDefault();
  };

  // Register events
  $document.on('click', SELECTOR_CALENDAR_LINK, onCalendarLinkAction);
});
