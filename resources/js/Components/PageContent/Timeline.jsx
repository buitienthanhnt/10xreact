const Timeline = ({content})=>{
	const jsonData = JSON.parse(content.value);
	return(
		<div className=""> 
		<p>{jsonData.typeValue}</p>
		<p>{jsonData.timeValue}</p>

		</div>
	)
}

export default Timeline;