$(document).ready(function() {
	//if (!$.select2)
	//	return;

	let $select2 = $('#dimensoes select, #filtro select').select2();

	// cache order of initial values
	let defaults = $select2.select2('data');
	defaults.forEach(obj=>{
		let order = $select2.data('preserved-order') || [];
	  order[ order.length ] = obj.text;
	  $select2.data('preserved-order', order)
	});

	function select2_renderSelections($select2,text){
		const order      = $select2.data('preserved-order') || [];
	  const $container = $select2.next('.select2-container');
	  const $tags      = $container.find('li.select2-selection__choice');
	  const $selected  = $tags.filter(`[title="${text}"]`);
	  const $input     = $tags.last().next();

	  // apply tag order
		order.forEach(text=>{
		let $el = $tags.filter(`[title="${text}"]`);
		$input.before( $el );
	  });
	}

	function selectionHandler(e){
		const $select2   = $(this);
	  const text       = e.params.data.text;
	  const order      = $select2.data('preserved-order') || [];


	  switch (e.type){
		case 'select2:select':
			order[ order.length ] = text;
		  break;
		case 'select2:unselect':
		  let found_index = order.indexOf(text);
		  if (found_index >= 0 )
			order.splice(found_index,1);
		  break;
	  }
	  $select2.data('preserved-order', order); // store it for later
	  select2_renderSelections($select2,text);
	}

	$select2.on('select2:select',selectionHandler).on('select2:unselect', selectionHandler);


	//$("ul.select2-selection__rendered").sortable({
	//	containment: 'parent',
	//	items: 'li:not(.select2-search)',
	//	update: function( event, ui ) {
	//		//$(this).parents('.select2-container').prev().trigger('change')
	//	}
	//})

})