import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import Baselayout from "../BaseLayout";
import BodyContent from "./Components/BodyContent";
import FootContent from "./Components/FootContent";
import TopContent from "./Components/TopContent";

const queryClient = new QueryClient()

const SingleLayout = ({ children, topMenu }) => {
    return (
        <QueryClientProvider client={queryClient}>
            <Baselayout>
                <TopContent />
                <BodyContent content={children}></BodyContent>
                <FootContent />
            </Baselayout>
        </QueryClientProvider>
    );
}

export default SingleLayout;
