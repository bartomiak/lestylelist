import { registerBlockType } from '@wordpress/blocks';
import { MediaUpload, MediaUploadCheck, MediaPlaceholder, BlockControls } from '@wordpress/block-editor';
import { Button, ToolbarGroup } from '@wordpress/components';
import { Fragment } from '@wordpress/element';


registerBlockType('lestyle/vertical-scroll-image-gallery', {
    title: 'Vertical Scroll Image Gallery',
    icon: 'smiley',
    category: 'layout',
    attributes: {
        images: {
            type: 'array',
            default: [],
        }
    },
    edit: EditComponent,
    save: function (props) {
        return null
    }
});

function EditComponent(props) {
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
        <Fragment>
            <MediaUploadCheck>
                {images.length === 0 ? (
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
                        value={images.map(image => image.id)}
                        render={({ open }) => (
                            <Button onClick={open} isSecondary>
                                Edit Gallery
                            </Button>
                        )}
                    />
                )}
            </MediaUploadCheck>
            <div className="vertical-scroll-gallery" style={{ maxHeight: '50vh', overflowY: 'auto' }}>
                {images.map((image) => (
                    <img key={image.id} src={image.url} alt={image.alt} className="gallery-image" style={{ width: '100%' }} />
                ))}
            </div>
        </Fragment>
    );
}
