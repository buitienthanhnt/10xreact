function TextEditorType(params) {
	return (
		<p dangerouslySetInnerHTML={{ __html: params.content.value }}></p>
	)
}

export default TextEditorType