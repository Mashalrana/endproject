import DefaultLayout from "@/Layouts/DefaultLayout";
import { Button } from "@/Shadcn/Button";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/Shadcn/Card";

const Home = () => {
    return (
        <DefaultLayout>
            <Card className="mt-7 lg:mt-14">
                <CardHeader>
                    <CardTitle>Laravel boilerplate</CardTitle>
                    <CardDescription>
                        This boilerplate is owned by @lemonlabs
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div className="flex flex-col space-y-4">
                        <p>
                            <strong>
                                This is a Laravel boilerplate with a React
                                frontend using Shadcn UI.
                            </strong>
                        </p>

                        <p>
                            If you want to start building your frontend, you can
                            begin by importing Shadcn components manually.
                            Please visit the{" "}
                            <a
                                href="https://ui.shadcn.com/"
                                className="underline"
                                target="_blank"
                            >
                                Shadcn UI documentation
                            </a>
                        </p>

                        <p>
                            For icons you can use Lucide icons from{" "}
                            <a
                                href="https://lucide.dev/icons/"
                                className="underline"
                                target="_blank"
                            >
                                https://lucide.dev/icons/
                            </a>
                            <div></div>
                        </p>

                        <p>
                            <strong>Need help?</strong>{" "}
                            <a
                                href="mailto:tristan@lemonlabs.nl"
                                className="underline"
                                target="_blank"
                            >
                                tristan@lemonlabs.nl
                            </a>
                        </p>
                    </div>
                </CardContent>
            </Card>
        </DefaultLayout>
    );
};

export default Home;
