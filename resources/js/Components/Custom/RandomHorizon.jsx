import usePageRandom from "@/hook/usePageRandom";
import { HorizonList } from "../PageComponent";

const RandomHorizon = () => {
	const { pages, isLoading } = usePageRandom();

	if (isLoading || !pages) {
		return null;
	}
	return (
		<HorizonList items={pages}></HorizonList>
	)
}

export default RandomHorizon