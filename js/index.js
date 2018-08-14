$('#home-slider').on('slide.bs.carousel', function (e) {
  
  var slideFrom = $(this).find('.active').index();
  var slideTo = $(e.relatedTarget).index();
  
  $('.list-group-item').eq(slideFrom).removeClass('active');
  $('.list-group-item').eq(slideTo).addClass('active');

});