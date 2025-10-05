const ImagePage = (props) => {
	return (
		<img src={props.source} alt={props?.title || 'image source'} className={`object-cover h-auto ${props.className}`} />
	)
}

export default ImagePage;