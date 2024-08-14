import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';
import { useEffect, useState } from 'react';

export default function Edit( { attributes, setAttributes } ) {
    const { categoryId } = attributes;
    const [apiData, setApiData] = useState(null);

    useEffect(() => {
        const fetchData = async () => {
            const response = await fetch(`https://swampthings-local.ddev.site/wp-json/jess-block-scaffold-experiments/v1/open/${categoryId}`);
            const data = await response.json();
            setApiData(data);
        };

        fetchData();
    }, [categoryId]);

    return (
        <>
            <InspectorControls>
                <PanelBody title={ __( 'Settings', 'cjess-block-scaffold-experiment' ) }>
                    <TextControl
                        label={ __( 'Category ID', 'cjess-block-scaffold-experiment' ) }
                        value={ categoryId }
                        onChange={ ( value ) => setAttributes( { categoryId: value } ) }
                    />
                </PanelBody>
            </InspectorControls>
            <div { ...useBlockProps() }>
                { apiData ? (
                    <div>
                        {/* Display fetched data here */}
                        {/* Example: */}
                        <p>Title: {apiData.title}</p>
                        <p>Content: {apiData.content}</p>
                    </div>
                ) : (
                    <p>Loading...</p>
                )}
            </div>
        </>
    );
}
