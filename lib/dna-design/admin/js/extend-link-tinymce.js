/*
	Extend Link
	By Alobaidi
	http://wp-plugins.in
*/

(function() {

	tinymce.PluginManager.add('wptp_extend_link_tinymce', function( editor, url ) {

		editor.addButton( 'wptp_extend_link_tinymce', {

			text: '',

			title: 'Insérer/modifier un CTA',

			icon: 'link',

			onclick: function() {
				var wptExtLinkGetSelection = tinyMCE.activeEditor.selection;

				var wptExtLinkSelectedText = wptExtLinkGetSelection.getContent( { format: "text" } );

				if( !wptExtLinkSelectedText ){
					alert('Vous devez choisir un texte');
					return false;
				}

				var wptExtLinkGetHref = wptExtLinkGetSelection.getNode().getAttribute('href');

				var wptExtLinkGetRel = wptExtLinkGetSelection.getNode().getAttribute('rel');

				var wptExtLinkGetTitle = wptExtLinkGetSelection.getNode().getAttribute('title');

				var wptExtLinkGetID = wptExtLinkGetSelection.getNode().getAttribute('id');

				var wptExtLinkGetClass = wptExtLinkGetSelection.getNode().getAttribute('class');

				var wptExtLinkGetTarget = wptExtLinkGetSelection.getNode().getAttribute('target');

				var wptExtLinkGetDownload = wptExtLinkGetSelection.getNode().getAttribute('download');

				if( wptExtLinkGetTarget ){
					var wptexl_TargetChecked = true;
				}else{
					var wptexl_TargetChecked = false;
				}

				if( wptExtLinkGetDownload ){
					var wptexl_DownloadChecked = true;
				}else{
					var wptexl_DownloadChecked = false;
				}

				editor.windowManager.open( {

					title: 'CTA',

					body: [
							{
								type: 'textbox',
								name: 'wptexl_LinkText',
								label: 'Label',
								value: wptExtLinkSelectedText,
								minWidth: 400
							},

							{
								type: 'textbox',
								name: 'wptexl_URL',
								label: 'URL',
								value: wptExtLinkGetHref,
								minWidth: 400
							},

							{
								type: 'textbox',
								name: 'wptexl_Title',
								label: 'Title',
								value: wptExtLinkGetTitle,
								minWidth: 400
							},

							{
								type: 'textbox',
								name: 'wptexl_Class',
								label: 'Class',
								value: wptExtLinkGetClass,
								minWidth: 400
							},

							{
								type: 'checkbox',
								name: 'wptexl_Target',
								label: 'Nouvelle fenêtre',
								checked: wptexl_TargetChecked
							},
					],

					onsubmit: function(e) {

						if( e.data.wptexl_Rel ){
							var wptexlAttrRel = ' rel="'+e.data.wptexl_Rel+'"';
						}else{
							var wptexlAttrRel = null;
						}

						if( e.data.wptexl_Title ){
							var wptexlAttrTitle = ' title="'+e.data.wptexl_Title+'"';
						}else{
							var wptexlAttrTitle = null;
						}

						if( e.data.wptexl_Class ){
							var wptexlAttrClass = ' class="'+e.data.wptexl_Class+' btn"';
						}else{
							var wptexlAttrClass = ' class="btn"';
						}

						if( e.data.wptexl_Target === true){
							var wptexlAttrTarget = ' target="_blank"';
						}else{
							var wptexlAttrTarget = null;
						}

                		editor.insertContent('<a href="'+e.data.wptexl_URL+'"'+wptexlAttrRel+wptexlAttrTitle+wptexlAttrClass+wptexlAttrTarget+'>'+e.data.wptexl_LinkText+'</a>');
            		}

				})

			}

		});

	});

})();