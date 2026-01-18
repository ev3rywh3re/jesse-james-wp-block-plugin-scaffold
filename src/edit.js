import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
	const { categoryId } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={ __( 'Settings', 'jess-block-scaffold-experiment' ) }
				>
					<TextControl
						label={ __(
							'Category ID',
							'jess-block-scaffold-experiment'
						) }
						value={ categoryId }
						onChange={ ( value ) =>
							setAttributes( {
								categoryId: parseInt( value, 10 ),
							} )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...useBlockProps() }>
				{ /* ... rest of your block content ... */ }
			</div>
		</>
	);
}
