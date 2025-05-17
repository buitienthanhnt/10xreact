import React from "react";

const BodyContent = ({ content, children }) => {

    return (
        <div className="container mx-auto p-2">
            {content}
            {children}
        </div>
    )
}

export default BodyContent;
