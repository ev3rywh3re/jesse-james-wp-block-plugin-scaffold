import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';

export default function Edit({ attributes, setAttributes }) {
    const { categoryId } = attributes;

    // Fetch categories using useSelect
    const { categories, isLoading } = useSelect((select) => {
        const { getCategories, isGetCategoriesLoading } = select('core');
        return {
            categories: getCategories({ per_page: -1 }), // Fetch all categories
            isLoading: isGetCategoriesLoading(),
        };
    }, []);

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Settings', 'jess-block-scaffold-experiment')}>
                    {isLoading ? (
                        <p>Loading categories...</p>
                    ) : (
                        <SelectControl
                            label={__('Category', 'jess-block-scaffold-experiment')}
                            value={categoryId}
                            options={[
                                { value: '', label: 'Select a category' },
                                ...categories.map((category) => ({
                                    value: category.id,
                                    label: category.name,
                                })),
                            ]}
                            onChange={(value) => setAttributes({ categoryId: value })}
                        />
                    )}
                </PanelBody>
            </InspectorControls>
            <div {...useBlockProps()}>
                {/* ... rest of your block content ... */}
            </div>
        </>
    );
}
