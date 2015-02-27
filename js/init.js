$(document).ready(function() {
  $('#parground').particleground({
    dotColor: '#0AFE0A',
    lineColor: '#0AFE74',
    particleRadius: 9,
    curvedLines: true,
    maxSpeedX: 1,
    density: 11000
  });
  $('.mega').css({
    'margin-top': -($('.mega').height() / 2)
  });
});