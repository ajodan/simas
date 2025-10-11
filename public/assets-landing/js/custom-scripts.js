$(document).ready(function(){
  'use strict';

  //===== Header Search =====//
  $('.srch-btn').on('click', function () {
    $('.header-search').addClass('active');
    return false;
  });
  $('.srch-cls-btn').on('click', function () {
    $('.header-search').removeClass('active');
    return false;
  });

  //===== Side Panel =====//
  $(".sidepanel > span").on('click', function () {
    $(".sidepanel").toggleClass("show");
    $(this).toggleClass('spin');
    return false;
  });

  //===== Color Picker =====*/
  $('.color-picker a').on("click", function () {
    $('.color-picker a').removeClass("applied");
    $(this).addClass("applied");
    return false;
  });

  //===== Responsive Header =====//
  $('.rspn-mnu-btn').on('click', function () {
    $('.rsnp-mnu').addClass('slidein');
    return false;
  });
  $('.rspn-mnu-cls').on('click', function () {
    $('.rsnp-mnu').removeClass('slidein');
    return false;
  });
  $('.rsnp-mnu li.menu-item-has-children > a').on('click', function () {
    $(this).parent().siblings().children('ul').slideUp();
    $(this).parent().siblings().removeClass('active');
    $(this).parent().children('ul').slideToggle();
    $(this).parent().toggleClass('active');
    return false;
  });

  //===== Scrollbar =====//
  if ($('.rsnp-mnu').length > 0) {
    var ps = new PerfectScrollbar('.rsnp-mnu');
  }

  //===== LightBox =====//
  if ($.isFunction($.fn.fancybox)) {
    $('[data-fancybox],[data-fancybox="gallery"]').fancybox({});
  }
  
	if ($.isFunction($.fn.fancybox)) {
		$(".fancybox")
		 .attr('rel', 'gallery')
		 .fancybox({
		  type: "iframe",
		  beforeShow: function () {
		   }
		 });
	}

  //===== Select =====//
  if ($('select').length > 0) {
    $('select').selectpicker();
  }

  //===== TouchSpin =====//
  if ($.isFunction($.fn.TouchSpin)) {
    $('.quantity > input').TouchSpin();
  }

  //===== Count Down =====//
  if ($.isFunction($.fn.downCount)) {
    $('.countdown').downCount({
      date: '12/12/2023 12:00:00',
      offset: +5
    });
  }

  //===== Owl Carousel =====//
  if ($.isFunction($.fn.owlCarousel)) {

    //=== Donation Carousel ===//
    $('.dnt-car').owlCarousel({
      autoplay: true,
      smartSpeed: 3000,
      loop: true,
      items: 1,
      dots: false,
      slideSpeed: 2000,
      autoplayHoverPause: true,
      nav: true,
      margin: 0,
      animateIn: 'fadeIn',
      animateOut: 'fadeOut',
      navText: [
      "<i class='fa fa-angle-left'></i>",
      "<i class='fa fa-angle-right'></i>"
      ],
    });

    //=== Testimonials Carousel ===//
    $('.testi-car').owlCarousel({
      autoplay: true,
      smartSpeed: 3000,
      loop: true,
      items: 3,
      dots: false,
      slideSpeed: 2000,
      autoplayHoverPause: true,
      nav: true,
      margin: 30,
      navText: [
      "<i class='fa fa-angle-left'></i>",
      "<i class='fa fa-angle-right'></i>"
      ],
      responsive:{
        0:{items: 1,nav: false},
        481:{items: 1,margin: 30},
        771:{items: 2,margin: 30},
        981:{items: 3,margin: 30},
        1025:{items: 3,margin: 30},
        1200:{items: 3}
      }
    });

    //=== Latest Carousel ===//
    $('.ltst-car').owlCarousel({
      autoplay: true,
      smartSpeed: 3000,
      loop: true,
      items: 1,
      dots: false,
      slideSpeed: 2000,
      autoplayHoverPause: true,
      nav: true,
      margin: 0,
      animateIn: 'fadeIn',
      animateOut: 'fadeOut',
      navText: [
      "<i class='fa fa-angle-left'></i>",
      "<i class='fa fa-angle-right'></i>"
      ],
    });
	
	$('.featured-area').owlCarousel({
		autoplay: true,
		autoplayTimeout: 5000,
		autoplayHoverPause: true,
		loop:true,
		margin:0,
		nav:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});

  }

  //===== Calendar AJAX Navigation =====//
  $('#prev-month, #next-month').on('click', function() {
    var month = $(this).data('month');
    var year = $(this).data('year');

    $('#loading-indicator').removeClass('hidden');
    $('#calendar-container').addClass('opacity-50');

    $.ajax({
      url: '/agenda',
      type: 'GET',
      data: { month: month, year: year },
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(response) {
        $('#calendar-container').html(response.calendar);
        $('#current-month-title').text(response.month);
        updateNavigationButtons(month, year);
      },
      error: function(xhr, status, error) {
        alert('Terjadi kesalahan saat memuat kalender. Silakan coba lagi.');
        console.error('AJAX Error:', error);
      },
      complete: function() {
        $('#loading-indicator').addClass('hidden');
        $('#calendar-container').removeClass('opacity-50');
      }
    });
  });

  //===== Agenda Date Click Handler =====//
  $(document).on('click', '#calendar-container div[data-date]', function() {
    var date = $(this).data('date');
    $('#modal-title').text('Agenda untuk Tanggal: ' + date);
    $('#modal-content').html('<p>Memuat data...</p>');
    $('#agenda-modal').removeClass('hidden');

    $.ajax({
      url: '/agenda/get-by-date',
      type: 'GET',
      data: { date: date },
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      },
      success: function(response) {
        if (response.data.length === 0) {
          $('#modal-content').html('<p>Tidak ada agenda untuk tanggal ini.</p>');
        } else {
          var html = '<ul class="list-disc pl-5 space-y-2">';
          response.data.forEach(function(agenda) {
            html += '<li><strong>' + agenda.judul + '</strong><br>' + agenda.deskripsi + '</li>';
          });
          html += '</ul>';
          $('#modal-content').html(html);
        }
      },
      error: function(xhr, status, error) {
        $('#modal-content').html('<p>Gagal memuat data agenda.</p>');
        console.error('AJAX Error:', error);
      }
    });
  });

  $('#close-modal').on('click', function() {
    $('#agenda-modal').addClass('hidden');
  });

  function updateNavigationButtons(currentMonth, currentYear) {
    var prevMonth = new Date(currentYear, currentMonth - 2, 1); // Month is 0-indexed in JS
    var nextMonth = new Date(currentYear, currentMonth, 1);

    $('#prev-month').data('month', prevMonth.getMonth() + 1).data('year', prevMonth.getFullYear());
    $('#next-month').data('month', nextMonth.getMonth() + 1).data('year', nextMonth.getFullYear());
  }

});//===== Document Ready Ends =====//


jQuery(window).on('load',function() {
  'use strict';
  $(".preloader").fadeOut("slow");
});

//===== Window onLoad Ends =====//
