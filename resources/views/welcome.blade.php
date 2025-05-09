<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>About Us</title>
        <script src="https://cdn.tailwindcss.com"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Rowdies:wght@700&display=swap"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Alice&display=swap"
            rel="stylesheet"
        />

        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            rowdies: ["Rowdies", "cursive"],
                            alice: ["Alice", "serif"],  <!-- Added Alice Font -->
                        }
                    }
                }
            };
        </script>
    </head>
    <body class="overflow-y-scroll bg-white mt-5 px-0 py-0 m-0 bg-white">
        <nav class="w-full bg-white py-2 px-10">
            <div
                class="container mx-auto flex justify-between items-center text-sm"
            >
                <div
                    class="text-md font-bold flex items-center font-rowdies font-light text-black"
                >
                <img src="/images/logo.jpg" alt="Logo" class="h-9 w-9 mr-2 rounded-full object-cover" />
                    Vistorio
                </div>
                <div
                    class="bg-gray-600 bg-opacity-30 p-1 rounded-[30px] border border-white flex space-x-3"
                >
                    <a
                        href="#about"
                        class="px-10 py-2 rounded-[20px] bg-grey-50 text-black hover:bg-[#778599]"
                        >About</a
                    >
                    <a
                        href="#services"
                        class="px-10 py-2 rounded-[20px] bg-transparent text-black hover:bg-[#778599]"
                        >Services</a
                    >
                    <a
                        href="#support"
                        class="px-10 py-2 rounded-[20px] bg-transparent text-black hover:bg-[#778599]"
                        >Support</a
                    >
                    <a
                        href="#contact"
                        class="px-10 py-2 rounded-[20px] bg-transparent text-black hover:bg-[#778599]"
                        >Contact</a
                    >
                </div>
                <div>
                    <a
                        href="{{ route('login') }}"
                        class="px-6 py-3 rounded-full border-2 border-[#1b2a39] text-[#1b2a39] bg-transparent hover:bg-[#1b2a39] hover:text-white text-base font-semibold transition-all duration-300 transform hover:scale-105"
                    >
                        Book an Appointment
                    </a>
                </div>
            </div>
        </nav>

        <section
            id="about"
            class="h-[80vh] relative flex items-start text-white text-2xl px-10 p-0 overflow-hidden bg-white"
        >
            <img
                src="/images/vistorio.jpg"
                alt="About Us Image"
                class="absolute top-0 left-0 w-full h-full object-cover z-0"
            />

            <div
                class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-white to-transparent z-10"
            ></div>

            <div class="flex flex-col items-left text-left max-w-md z-20">
                <h2 class="px-5 mt-[160px] text-5xl font-alice text-black">
                    Vistorio
                </h2>
                <p
                    class="mt-2 text-5xl px-5 text-black font-rowdies whitespace-nowrap"
                >
                    Appointments Made Easy
                </p>
                <p class="mt-10 px-5 text-lg text-black font-calibri max-w-lg">
                    Book your Appointment with Ease, Experience a hassle-free
                    appointment system designed to streamline your scheduling
                    process. 
                </p>
                <a
                    href="#"
                    class="mt-6 ml-5 w-fit px-6 py-3 rounded-full border-2 border-[#1b2a39] text-[#1b2a39] bg-transparent hover:bg-[#1b2a39] hover:text-white text-base font-semibold transition-all duration-300 transform hover:scale-105"
                >
                    View Properties
                </a>
            </div>
        </section>

        <!-- Services Section -->
        <section
            id="services"
            class="relative -mt-32 z-30 py-16 bg-light_grey flex flex-col items-center justify-center text-neutral text-2xl px-10"
        >
            <div
                class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8"
            >
                <div
                    class="bg-white rounded-lg shadow-lg shadow-black/30 border border-black/10 p-6 text-center"
                >
                    <div
                        class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4"
                    >
                    <img src="{{ asset('images/agent.png') }}" alt="Agent Icon" class="w-15 h-15" />
                    </div>
                    <h3 class="text-xl font-semibold text-neutral mb-2">
                        Trusted Agents
                    </h3>
                    <p class="text-neutral opacity-70 text-sm">
                        Our licensed professionals guide you through every step
                        of the buying or renting process.
                    </p>
                </div>
                <div
                    class="bg-white rounded-lg shadow-lg shadow-black/30 border border-black/10 p-6 text-center"
                >
                    <div
                        class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4"
                    >
                    <img src="{{ asset('images/verify.png') }}" alt="Verify Icon" class="w-15 h-15" />
                    </div>
                    <h3 class="text-xl font-semibold text-neutral mb-2">
                        Verified Listings
                    </h3>
                    <p class="text-neutral opacity-70 text-sm">
                        We offer a wide range of thoroughly vetted properties to
                        match your needs and budget.
                    </p>
                </div>
                <div
                    class="bg-white rounded-lg shadow-lg shadow-black/30 border border-black/10 p-6 text-center"
                >
                    <div
                        class="bg-primary text-white rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4"
                    >
                    <img src="{{ asset('images/appointment.png') }}" alt="Appointment Icon" class="w-15 h-15" />

                    </div>
                    <h3 class="text-xl font-semibold text-neutral mb-2">
                        Seamless Appointments
                    </h3>
                    <p class="text-neutral opacity-70 text-sm">
                        Easily schedule viewings with our intuitive booking
                        system—no hassle, no delays.
                    </p>
                </div>
            </div>
        </section>

        <div
            class="flex flex-col lg:flex-row justify-center items-stretch gap-6 bg-white px-4 py-6"
        >
            <!-- Support Section -->
            <section
                id="support"
                class="flex-1 bg-white flex flex-col items-center text-black rounded-md shadow-md"
            >
                <h2
                    class="bg-slate-700 px-3 py-2 rounded-t-md text-white text-sm w-full text-center"
                >
                    24/7 Support
                </h2>
                <div class="w-full space-y-4 p-5">
                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-black flex items-center justify-center mr-3"
                        >
                        </div>
                        <div>
                            <h3 class="font-semibold text-sm text-gray-800">
                                Real Estate Agent
                            </h3>
                            <p class="text-xs text-gray-600">
                                Contact your personal agent for property
                                inquiries
                            </p>
                            <button
                                class="mt-2 px-4 py-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-600 text-xs"
                            >
                                Call Now
                            </button>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-black flex items-center justify-center mr-3"
                        >
                        </div>
                        <div>
                            <h3 class="font-semibold text-sm text-gray-800">
                                Live Chat Support
                            </h3>
                            <p class="text-xs text-gray-600">
                                Get instant answers to your questions
                            </p>
                            <button
                                class="mt-2 px-4 py-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-600 text-xs"
                            >
                                Start Chat
                            </button>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div
                            class="w-8 h-8 rounded-full bg-black flex items-center justify-center mr-3"
                        >
                        </div>
                        <div>
                            <h3 class="font-semibold text-sm text-gray-800">
                                Property Management
                            </h3>
                            <p class="text-xs text-gray-600">
                                Contact our management team with any issues
                            </p>
                            <button
                                class="mt-2 px-4 py-1.5 bg-blue-500 text-white rounded-md hover:bg-blue-600 text-xs"
                            >
                                Contact
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section
                id="contact"
                class="flex-1 bg-white flex flex-col items-center text-black rounded-md shadow-md"
            >
                <h2
                    class="bg-slate-700 px-3 py-2 rounded-t-md text-white text-sm w-full text-center"
                >
                    Contact Us
                </h2>
                <p class="mt-2 text-center text-black text-xs max-w-xs mx-auto">
                    Get in touch with us via email or phone to start your
                    journey today.
                </p>
                <form
                    onsubmit="return false;"
                    class="mt-4 space-y-2 w-full px-5 pb-5"
                >
                    <input
                        type="text"
                        placeholder="Your Name"
                        class="w-full p-2 border border-gray-300 rounded-md text-sm"
                    />
                    <input
                        type="email"
                        placeholder="Your Email"
                        class="w-full p-2 border border-gray-300 rounded-md text-sm"
                    />
                    <textarea
                        placeholder="Your Message"
                        class="w-full p-2 border border-gray-300 rounded-md text-sm"
                        rows="3"
                    ></textarea>
                    <button
                        type="submit"
                        class="w-full px-4 py-1 bg-blue-500 text-white rounded-md text-sm hover:bg-blue-600"
                    >
                        Send Message
                    </button>
                </form>
            </section>
        </div>

        <!-- Social Media Links -->
        <div
            class="text-center bg-white text-black p-4 rounded-md shadow-sm w-full"
        >
            <h3
                class="font-semibold text-sm mb-2 bg-slate-700 text-white px-2 py-1 rounded-md w-full inline-block"
            >
                Follow Us
            </h3>

            <div class="flex justify-center space-x-6 text-xl">
                <a
                    href="https://facebook.com"
                    target="_blank"
                    class="hover:text-blue-600"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        class="w-10 h-10"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M22 12.07C22 6.5 17.52 2 12 2S2 6.5 2 12.07c0 4.97 3.66 9.1 8.44 9.88v-7h-2.54v-2.88h2.54v-2.2c0-2.5 1.5-3.88 3.78-3.88 1.1 0 2.24.2 2.24.2v2.48h-1.26c-1.24 0-1.63.78-1.63 1.57v1.84h2.78l-.44 2.88h-2.34v7C18.34 21.17 22 17.04 22 12.07z"
                        />
                    </svg>
                </a>
                <a
                    href="https://twitter.com"
                    target="_blank"
                    class="hover:text-blue-400"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        class="w-10 h-10"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M22.46 6c-.77.35-1.6.58-2.46.69a4.29 4.29 0 001.88-2.37 8.59 8.59 0 01-2.72 1.04 4.27 4.27 0 00-7.3 3.89 12.12 12.12 0 01-8.8-4.46 4.27 4.27 0 001.32 5.7 4.25 4.25 0 01-1.94-.54v.05a4.27 4.27 0 003.43 4.18 4.27 4.27 0 01-1.93.07 4.27 4.27 0 003.99 2.97A8.57 8.57 0 012 19.54a12.07 12.07 0 006.56 1.92c7.88 0 12.2-6.53 12.2-12.2 0-.19-.01-.39-.02-.58A8.72 8.72 0 0022.46 6z"
                        />
                    </svg>
                </a>
                <a
                    href="https://instagram.com"
                    target="_blank"
                    class="hover:text-pink-500"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor"
                        class="w-10 h-10"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M7.75 2C5.13 2 3 4.13 3 6.75v10.5C3 19.87 5.13 22 7.75 22h8.5c2.62 0 4.75-2.13 4.75-4.75V6.75C21 4.13 18.87 2 16.25 2h-8.5zm0 1.5h8.5C18.1 3.5 19.5 4.9 19.5 6.75v10.5c0 1.85-1.4 3.25-3.25 3.25h-8.5C5.9 20.5 4.5 19.1 4.5 17.25V6.75C4.5 4.9 5.9 3.5 7.75 3.5zm8.75 2.25a.75.75 0 100 1.5.75.75 0 000-1.5zM12 7a5 5 0 100 10 5 5 0 000-10zm0 1.5a3.5 3.5 0 110 7 3.5 3.5 0 010-7z"
                        />
                    </svg>
                </a>
            </div>
        </div>

        <footer class="bg-[#1b2a39] text-white py-5">
            <div class="w-full px-6 text-center">
                <p class="text-sm opacity-70">
                    © 2025 Vistorio Appointment & Visitor Management System. All
                    rights reserved.
                </p>
            </div>
        </footer>
    </body>
</html>
