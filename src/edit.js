import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';
import { useEffect, useState } from 'react';

export default function Edit( { attributes, setAttributes } ) {
    const { categoryId } = attributes;
    const [apiData, setApiData] = useState(null);

    // Move the fetch logic inside the useEffect callback
    useEffect(() => {
        // Avoid fetching if categoryId is empty
        if (!categoryId) {
            return;
        }

        const fetchData = async () => {
            const response = await fetch(`https://swampthings-local.ddev.site/wp-json/jess-block-scaffold-experiments/v1/open/${categoryId}`);
            
            if (!response.ok) {
                console.error('Error fetching data:', response.status);
                setApiData(null); // Clear previous data on error
                return;
            }

            const data = await response.json();
            console.log(data);
            setApiData(data);
        };

        fetchData();
    }, [categoryId]); // Now useEffect runs whenever categoryId changes

    return (
        <>
            <InspectorControls>
                <PanelBody title={ __( 'Settings', 'jess-block-scaffold-experiment' ) }>
                    <TextControl
                        label={ __( 'Category ID', 'jess-block-scaffold-experiment' ) }
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
