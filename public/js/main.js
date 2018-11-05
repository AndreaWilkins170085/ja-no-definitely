console.log("ready!");




jQuery(function($) {
  var $bodyEl = $('body'),
  $sidedrawerEl = $('#sidedrawer');
  
  
  // ==========================================================================
  // Toggle Sidedrawer
  // ==========================================================================
  function showSidedrawer() {
    
    // show overlay
    var options = {
      onclose: function() {
        $sidedrawerEl
          .removeClass('active')
          .appendTo(document.body);
      }
    };

    
    var $overlayEl = $(mui.overlay('on', options));
    
    // show element
    $sidedrawerEl.appendTo($overlayEl);
    setTimeout(function() {
      
      $sidedrawerEl.addClass('active');
    }, 20);
  }
  
  
  function hideSidedrawer() {
    
    console.log("closed");
    
    $bodyEl.toggleClass('hide-sidedrawer');
  }
  
  
  $('.js-show-sidedrawer').on('click', showSidedrawer);
  $('.js-hide-sidedrawer').on('click', hideSidedrawer);
  
  
  // ==========================================================================
  // Animate menu
  // ==========================================================================
  var $titleEls = $('strong', $sidedrawerEl);
  
  $titleEls
    .next()
    .hide();
  
  $titleEls.on('click', function() {
    $(this).next().slideToggle(200);
  });

  // $('.answer-btn').onclick(function() {
  //   $(this).parent().find('.answerForm').show();
  // })

  $("#search").on("keyup", function() {
    var search = $(this).val().toLowerCase();
    $(".questionAsked .authorInfo").each(function() {
        var results = $(this).text().toLowerCase();
        $(this).closest('.questionAsked')[ results.indexOf(search) !== -1 ? 'show' : 'hide' ]();
    });
  });
  
});
  
//Show/Hide Answer Form

function answerQuestion() {
  var x = document.getElementById("answerForm");
  if (x.style.display === "none") {
      x.style.display = "block";
  } else {
      x.style.display = "none";
  }
}

