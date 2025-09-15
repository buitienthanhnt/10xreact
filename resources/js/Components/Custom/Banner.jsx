const Banner = (props)=>{

	return(
		<div className={`bg-white rounded-md justify-center items-center flex relative ${props.layout}`} onClick={props?.onClick}>
			<div className="absolute top-10 left-10 p-2 px-4 rounded-md shadow-white shadow-lg hover:scale-125" style={{backgroundColor: 'rgba(255, 255, 255, 0.27)'}}>
				<span className="text-lg text-red-700 font-bold ">
					demo for text of banner
				</span>
			</div>
			<img src="https://img-s-msn-com.akamaized.net/tenant/amp/entityid/AA1Mwn6I.img?w=768&h=512&m=6" alt="banner" 
				className="flex-1 rounded-lg object-cover h-1/2 lg:max-h-[720px]" style={{height: props.height}}
			/>
		</div>
	)
}

export default Banner;