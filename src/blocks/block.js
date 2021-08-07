const { __ } = wp.i18n; 
const { Component } = wp.element;
const { registerBlockType } = wp.blocks; 
const { InnerBlocks, RichText, InspectorControls, ColorPalette, BlockAlignmentToolbar, AlignmentToolbar, PlainText } = wp.editor;
const { TextControl, SelectControl, RangeControl, IconButton, PanelBody } = wp.components;


class EditorComponent extends Component {

	constructor() {
		super( ...arguments );
		this.state = {
			isEditing: false
		}
	}

	componentDidMount() {
		const randomKey = "myModal" + Math.floor(Math.random() * 1000);
		this.props.setAttributes({randomKey: randomKey});
	}

	render() {
		const { attributes, setAttributes, isSelected} = this.props;

		const colorControl = (attributeName, title) => {
			return [
				<p>{__(title)}</p>,
				<ColorPalette
					onChange={ ( value ) => {
						const update = {};
						update[attributeName] = value;
						setAttributes( update )
						}
					}
				/>
			];
		}

		const styles = {
			colorPreview: {
				borderRadius: attributes.borderRadius,
				width: "100%",
				height: "60px",
				backgroundColor: attributes.textBackgroundColor,
				boxShadow: "0 2px 5px rgba(0, 0, 0, 0.5)",
				marginBottom: "3px",
			},
			contentColor: {
				backgroundColor: attributes.titleBackgroundColor,
                padding:"15px 5%",
			},
            contentText: {
                color: attributes.titleColor,
            },
			button: {
				backgroundColor: attributes.buttonColor,
				color: attributes.buttonTextColor,
			},
		}

		const controls = isSelected && [
			 <InspectorControls>
				<PanelBody title={ __( 'Content Settings' ) } initialOpen={false}>
					{colorControl('titleColor', 'Content Text Color')}
					{colorControl('titleBackgroundColor', 'Content Background Color')}
				</PanelBody>
				<PanelBody title={ __( 'Button Settings' ) } initialOpen={false}>
					{colorControl('buttonTextColor', 'Button Text Color')}
					{colorControl('buttonColor', 'Button Background Color')}
                    <RangeControl
                        label={ __("Rounded Corners: ") }
                        value={ (attributes.borderRadius / 3) }
                        min={ 0 }
                        max={ 5 }
                        onChange={ (value) => setAttributes( { borderRadius: (value * 3) } ) }
                    />
				</PanelBody>
			</InspectorControls>
		]

		return [
			controls,
			isSelected || this.state.isEditing
				?
					<BlockAlignmentToolbar
						value={attributes.align}
						onChange={ (value) => {
							setAttributes( { align: value === 'right' ? 'flex-end' : value } )
						} }
					/>
				: 
					null,
			(
            <div>
                <input 
                    id="demoA"
                    type="button"
                    style={styles.button}
                    value={ attributes.buttonText } 
                    className='trigger_popup_fricc'
                    onChange={ ( value ) => setAttributes( { buttonText: value } ) }
                />
                <br></br>
                <h4> Button Text : </h4>
                <RichText
                    tagName="p"
                    placeholder={ __( 'Click here', 'ultimate-addons-for-gutenberg' ) }
                    keepPlaceholderOnFocus
                    value={ attributes.buttonText }
                    className='trigger_popup_fricc'
                    onChange={ ( value ) => setAttributes( { buttonText: value } ) }
                />
                <h4> Pop-up Content : </h4>
                <div style={ styles.contentColor }>
                <InnerBlocks allowedBlocks={ ["core/heading"] }/>
                <RichText
                    tagName="p"
                    placeholder={ __( 'Add any HTML content', 'ultimate-addons-for-gutenberg' ) }
                    style={ styles.contentText }
                    value={ attributes.title }
                    onChange={ ( value ) => setAttributes( { title: value } ) }
                />
                </div>
            </div>
		    )
		];
	}
}

registerBlockType( 'ultimate-popup/block-ultimate-popup', {
	title: __( 'PopUp' ),
	icon: 'external', 
	category: 'common', 
	description: __( 'Customize modal pop-up.' ),
	keywords: [
		__( 'Pop-up' ),
		__( 'Block' ),
	],
	edit: EditorComponent,
	save: function() {
		return (<InnerBlocks.Content/>);
	},
} );