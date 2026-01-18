import { useBlockProps } from '@wordpress/block-editor';

export default function save( { attributes } ) {
	const { categoryId } = attributes;

	// You'll need to fetch the data again here if you want to display it in the saved content.
	// Alternatively, you could store the data in a custom field or use a different approach.

	return (
		<div { ...useBlockProps.save() }>
			{ /* Display fetched data here */ }
		</div>
	);
}
