/* global manualdog_sort_data, jQuery */
/**
 * ManualDog Sort
 * Handles nestable2 drag-and-drop sorting on the Sort Order page.
 */
( function ( $ ) {
	'use strict';

	const saveBtn    = document.getElementById( 'manualdog-sort-save-btn' );
	const statusEl   = document.getElementById( 'manualdog-sort-status' );
	const nestableEl = document.getElementById( 'manualdog-nestable' );

	if ( ! saveBtn || ! nestableEl ) return;

	// nestable2 初期化.
	$( '#manualdog-nestable' ).nestable( {
		maxDepth: 5,
		collapseBtnHTML: '<button data-action="collapse" type="button" class="dd-collapse">▲</button>',
		expandBtnHTML:   '<button data-action="expand"   type="button" class="dd-expand">▼</button>',
		callback: function () {
			// 変更があったら保存ボタンをハイライト.
			saveBtn.classList.add( 'button-primary' );
		},
	} );

	/**
	 * Flattens the nestable2 serialized data into a flat array of items.
	 *
	 * @param {Array}  items    Nestable2 serialized array.
	 * @param {number} parentId Parent post ID (0 for root).
	 * @param {Array}  result   Output array (passed by reference).
	 */
	function flattenNestable( items, parentId, result ) {
		items.forEach( function ( item, index ) {
			result.push( {
				id:        item.id,
				parent_id: parentId,
				order:     index,
			} );
			if ( item.children && item.children.length ) {
				flattenNestable( item.children, item.id, result );
			}
		} );
	}

	// 保存.
	saveBtn.addEventListener( 'click', function () {
		const nestableData = $( '#manualdog-nestable' ).nestable( 'serialize' );
		const items        = [];
		flattenNestable( nestableData, 0, items );

		saveBtn.disabled = true;
		if ( statusEl ) {
			statusEl.textContent = manualdog_sort_data.i18n.saving;
		}

		const formData = new FormData();
		formData.append( 'action', 'manualdog_save_sort_order' );
		formData.append( 'nonce',  manualdog_sort_data.nonce );
		formData.append( 'items',  JSON.stringify( items ) );

		fetch( manualdog_sort_data.ajax_url, {
			method:      'POST',
			body:        formData,
			credentials: 'same-origin',
		} )
			.then( function ( res ) { return res.json(); } )
			.then( function ( data ) {
				saveBtn.disabled = false;
				if ( data.success ) {
					if ( statusEl ) {
						statusEl.textContent = manualdog_sort_data.i18n.saved;
					}
					setTimeout( function () {
						if ( statusEl ) {
							statusEl.textContent = '';
						}
					}, 3000 );
				} else {
					// eslint-disable-next-line no-alert
					window.alert( manualdog_sort_data.i18n.error );
					if ( statusEl ) {
						statusEl.textContent = '';
					}
				}
			} )
			.catch( function () {
				saveBtn.disabled = false;
				// eslint-disable-next-line no-alert
				window.alert( manualdog_sort_data.i18n.error );
				if ( statusEl ) {
					statusEl.textContent = '';
				}
			} );
	} );

} )( jQuery );
