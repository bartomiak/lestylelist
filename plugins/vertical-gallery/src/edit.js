import { MediaUpload, MediaUploadCheck, MediaPlaceholder, BlockControls } from '@wordpress/block-editor';
import { Button, ToolbarGroup } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit(props) {
	const { attributes, setAttributes } = props;
	const { images } = attributes;

	const onSelectImages = (newImages) => {
		const updatedImages = newImages.map((image) => ({
			id: image.id,
			url: image.url,
			alt: image.alt,
		}));
		setAttributes({ images: updatedImages });
	};

	return (
		<div {...useBlockProps()}>
			<Fragment>
				<MediaUploadCheck>
					{images?.length === 0 ? (
						<MediaPlaceholder
							onSelect={onSelectImages}
							allowedTypes={['image']}
							multiple
							labels={{ title: 'Gallery', instructions: 'Select images to create a gallery' }}
						/>
					) : (
						<MediaUpload
							onSelect={onSelectImages}
							allowedTypes={['image']}
							multiple
							gallery
							value={images?.map(image => image.id)}
							render={({ open }) => (
								<Button onClick={open} isSecondary>
									Edit Gallery
								</Button>
							)}
						/>
					)}
				</MediaUploadCheck>
				<div className="vertical-scroll-gallery" style={{ maxHeight: '50vh', overflowY: 'auto' }}>
					{images?.map((image) => (
						<img key={image.id} src={image.url} alt={image.alt} className="gallery-image" style={{ width: '100%' }} />
					))}
				</div>
			</Fragment>
		</div>
	);
}
