var blockSettings = {
	package		:	'webra',						// The package that contains the block
	slug		:	'test_block',					// The unique name of the block, slug
	title		:	'Yakirs Test Block',			// The block title in the editor
	desc		:	'a test block for webra theme',	// The block description in the editor
	icon		:	'businessman',					// The block icon in the editor, dashicons
	category	:	'common',						// The blocks category this block will belong to
}

var blockHTML = {
	title: {
		type: 'array',
		source: 'children',
		selector: 'h1',
	},
	subtitle: {
		type: 'array',
		source: 'children',
		selector: 'h2',
	},
	desc: {
		type: 'array',
		source: 'children',
		selector: 'p',
	},
	profile_image_ID: {
		type: 'number',
	},
	profile_image_URL: {
		type: 'string',
		source: 'attribute',
		selector: 'img',
		attribute: 'src',
	}
}

function register_gutenberg_block(blockSettings, blockHTML) {
	
	// Declare Variables 
	var editor = window.wp.editor;
	var components= window.wp.components;
	var i18n = window.wp.i18n;
	var element = window.wp.element;
	var el = element.createElement;
	var registerBlockType = wp.blocks.registerBlockType;
	var RichText = wp.editor.RichText;
	var BlockControls = wp.editor.BlockControls;
	var AlignmentToolbar = wp.editor.AlignmentToolbar;
	var MediaUpload = wp.editor.MediaUpload;
	var InspectorControls = wp.editor.InspectorControls;
	var TextControl = wp.components.TextControl;

	registerBlockType( blockSettings.package + '/' + blockSettings.slug, {
		title: i18n.__( blockSettings.title ), // The title of our block.
		description: i18n.__( blockSettings.desc ), // The description of our block.
		icon: blockSettings.icon, // Dashicon icon for our block. Custom icons can be added using inline SVGs.
		category: blockSettings.category,
		attributes: blockHTML,

		edit: function( props ) {
			
			var attributes = props.attributes;

			var onSelectImage = function( img ) {
				return props.setAttributes( {
					profile_image_URL: img.url,
					profile_image_ID: img.id,
				} );
			}

			function onChangeAlignment( newAlignment ) {
				props.setAttributes( { alignment: newAlignment } );
			}

			return [
				el( 'div', { className: props.className },
					el( RichText, {
						tagName: 'h1',
						placeholder: 'The H1 Value',
						keepPlaceholderOnFocus: true,
						value: attributes.title,
						isSelected: false,
						onChange: function( newTitle ) {
							props.setAttributes( { title: newTitle } );
						},
					} ),
					el( RichText, {
						tagName: 'h2',
						placeholder: 'The H2 Value',
						keepPlaceholderOnFocus: true,
						value: attributes.subtitle,
						isSelected: false,
						onChange: function( newTitle ) {
							props.setAttributes( { title: newTitle } );
						},
					} ),
					el( RichText, {
						tagName: 'p',
						placeholder: i18n.__( 'Write a value for the paragraph element' ),
						keepPlaceholderOnFocus: true,
						value: attributes.desc,
						onChange: function( newBio ) {
							props.setAttributes( { bio: newBio } );
						},
					} ),
					el( MediaUpload, {
						onSelect: onSelectImage,
						type: 'image',
						value: attributes.profile_image_ID,
						render: function( obj ) {
							return el( components.Button, {
								className: attributes.profile_image_ID ? 'image-button' : 'button button-large',
								onClick: obj.open
								},
								! attributes.profile_image_ID ? i18n.__( 'Upload Image' ) : el( 'img', { src: attributes.profile_image_URL } )
							);
						}
					} )
				)
			];
		},

		save: function( props ) {
			var attributes = props.attributes;
			return (
				el( 'div', {
					className: props.className
				},
					el( RichText.Content, {
						tagName: 'h1',
						value: attributes.title
					} ),
					el( RichText.Content, {
						tagName: 'h2',
						value: attributes.subtitle
					} ),
					el( RichText.Content, {
						tagName: 'p',
						value: attributes.desc
					} ),
					el( RichText.Content, {
						tagName: 'p',
						value: attributes.profile_image_ID
					} )
				)
			);
		}
}