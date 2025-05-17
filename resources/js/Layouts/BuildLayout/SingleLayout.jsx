import Baselayout from "../BaseLayout";
import BodyContent from "./Components/BodyContent";
import FootContent from "./Components/FootContent";
import TopContent from "./Components/TopContent";

const SingleLayout = ({ children, topMenu }) => {
    return (
        <Baselayout>
            <TopContent />
            <BodyContent content={children}></BodyContent>
            <FootContent />
        </Baselayout>
    );
}

export default SingleLayout;
