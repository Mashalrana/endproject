import { PropsWithChildren } from "react";

// import your own navbar and footer
// import Navbar from "../Navbar";
// import Footer from "../Footer";

interface PropsWithChildrenWithLoading extends PropsWithChildren {
    maxWidth?: boolean;
}

const DefaultLayout = ({
    children,
    maxWidth,
}: PropsWithChildrenWithLoading) => (
    <div className="flex flex-col min-h-screen">
        {/* <Navbar /> */}
        <main
            className={`px-6 lg:${
                maxWidth ? "w-full max-w-[1440px]" : "w-full"
            } lg:mx-auto mb-14`}
        >
            <div className="w-full">{children}</div>
        </main>
        {/* <Footer /> */}
    </div>
);

export default DefaultLayout;
