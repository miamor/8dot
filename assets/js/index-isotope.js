$(function () {
  var $container = $('#container').isotope({
    itemSelector: '.one-item',
    layoutMode: 'masonry',
    masonry: {
      columnWidth: 110
    },
    cellsByRow: {
      columnWidth: 220,
      rowHeight: 220
    },
    masonryHorizontal: {
      rowHeight: 110
    },
    cellsByColumn: {
      columnWidth: 220,
      rowHeight: 220
    }
  });

  var isHorizontal = false;
  var $window = $( window );

  $('#layout-mode-button-group').on( 'click', 'button', function() {
    // adjust container sizing if layout mode is changing from vertical or horizontal
    var $this = $(this);
    var isHorizontalMode = !!$this.attr('data-is-horizontal');
    if ( isHorizontal !== isHorizontalMode ) {
      // change container size if horiz/vert change
      var containerStyle = isHorizontalMode ? {
        height: $window.height() * 0.7
      } : {
        width: 'auto'
      };
      $container.css( containerStyle );
      isHorizontal = isHorizontalMode;
    }
    // change layout mode
    var layoutModeValue = $this.attr('data-layout-mode-value');
    $container.isotope({ layoutMode: layoutModeValue });
  });  

  // change is-checked class on buttons
  $('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      $( this ).addClass('is-checked');
    });
  });

});
