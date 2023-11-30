document.addEventListener( 'DOMContentLoaded', function () {
	if ( 0 === Number( swcp.show ) ) {
		return;
	}

	document.body.addEventListener( 'wc-blocks_added_to_cart', function ( e, frags, cartHash, button ) {
		console.log( e );
		console.log( frags );
		console.log( cartHash );
		console.log( button );
	});

	jQuery( $ => {
		$( document.body ).on( 'added_to_cart', function ( event, frags, cartHash, button ) {
			// check if wrapper exists
			let $popup = $( 'div.swcp-popup-wrapper' );

			// if wrapper exits delete
			if ( $popup.length > 0 ) {
				$popup.remove();
			}

			// create wrapper
			$popup = $( '<div/>' ).addClass( 'swcp-popup-wrapper popup-slide-in' );

			// get product html from add to cart fragment
			const id = button.data( 'product_id' ),
        	$frags = $( frags['div.widget_shopping_cart_content'] )
          		.find( `.remove.remove_from_cart_button[data-product_id="${id}"]` ).parent();
			var cartURL = $( frags['div.widget_shopping_cart_content'] ).find( '.button.wc-forward:not(.checkout)' );
			const $qty_raw = $frags.find('.quantity');
			var $qty = $qty_raw.html().replace(/^\d+ × /, '');

			// set css for bottom position
			if ( swcp.position === 'bottom' ) {
				$popup.css({
					top: 'auto',
					bottom: 0,
				});
			} else {
				if ($('body').hasClass('admin-bar')) {
					$popup.css({
						top: '6vh',
					});
				} 
			}

			// set css for image as background
			if ( swcp.layout === 'image_bg' ) {
				const $img = $frags.find( 'a > img' ),
					src = $img.attr( 'src' );

				$popup.addClass( 'image-as-bg' );
				$popup.css({
					backgroundImage: `url(${src})`,
				});
				$img.remove();
			}

			// remove "remove button", not needed
			$frags.find( '.remove.remove_from_cart_button' ).remove();
			var headingText = '<div class="heading-popup">';
			headingText += '<span>Added To Cart</span>';
			headingText += '</div>';

			var anchorElement = $frags.find('a');
			var anchorContents = anchorElement.contents();
			var textNode = anchorContents.filter(function() {
				return this.nodeType === 3; // Text node
			});

			anchorElement.addClass('anchorPopup');
			var $titleWrapper = $('<div class="title-wrapper"></div>');
			$titleWrapper.append(textNode);
			$titleWrapper.append($qty);
			anchorElement.append($titleWrapper);

			var buttonCart = $('<button class="redirect-to-cart">View Cart</button>');
			var buttonClose = $('<span id="close-popup_wrapper" class="btn_close_wrapper">x</span>');

			var lineContainer = $('<div class="line-container"></div>');
        	var lineElement = $('<div class="line"></div>');
			lineContainer.append(lineElement);
			
			$popup.append( headingText );
			$popup.append( $frags.html() );
			$popup.append( buttonCart );
			$popup.append( buttonClose );
			$popup.append( lineContainer );
            $popup.find('.quantity').not('.anchorPopup .quantity').remove();
			$popup.appendTo( 'body' );

			// Get the duration from swcp.close and set the line animation duration
			var lineAnimationDuration = swcp.close * 1000;
            $popup.css('--slide-duration', lineAnimationDuration + 'ms');
			lineElement.css('--line-duration', lineAnimationDuration + 'ms');

			setTimeout( () => {
				$popup.toggleClass('popup-slide-in popup-slide-out');
			}, lineAnimationDuration );

			lineElement.on('animationend', function() {
				setTimeout(function() {
					$popup.remove();
				}, 0.4 * 1000);
			});

			
			// Listen for the end of the popup-slide-out transition
			$popup.on('transitionend', function() {
				// Remove the popup after the transition is complete
				$popup.remove();
			});

			$('#close-popup_wrapper').on('click', function() {
				$('.swcp-popup-wrapper').hide();
			});
			$('.redirect-to-cart').on('click', function() {
				if (cartURL) {
					window.location.href = cartURL.attr('href');
				} else {
					console.error('Cart page URL not found.');
				}
			});

		});
	});
});