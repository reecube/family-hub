$(function () {
  'use strict';

  // Declare constants
  var VALUE_TRUE = 'true';
  var VALUE_FALSE = 'false';
  var ATTRIBUTE_ACTIVE = 'data-active';
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

    $calendarLinks.attr(ATTRIBUTE_ACTIVE, VALUE_FALSE);
    $self.attr(ATTRIBUTE_ACTIVE, VALUE_TRUE);

    event.preventDefault();
  };

  // Register events
  $document.on('click', SELECTOR_CALENDAR_LINK, onCalendarLinkAction);
});
