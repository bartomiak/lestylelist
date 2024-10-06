import { useState, useRef, useEffect } from "@wordpress/element";
import { debounce } from 'debounce';

const ReactSearch = ({ rootUrl }) => {
    const [results, setResults] = useState([]);
    const [searchActive, setSearchActive] = useState(false);
    const [searchQuery, setSearchQuery] = useState('');
    const [spinnerActive, setSpinnerActive] = useState(false);
    const [noResultsActive, setNoResultsActive] = useState(false);
    const searchInput = useRef(null);

    const setSearchToActive = () => {
        setSearchActive(true);
        setTimeout(() => searchInput.current?.focus(), 0); // Use timeout to simulate nextTick in React
    };

    const setSearchToInactive = () => {
        setSearchActive(false);
        setSearchQuery('');
    };

    const search = debounce(async () => {
        if (searchQuery.trim().length) {
            setSpinnerActive(true);
            setNoResultsActive(false);
            setResults([]);

            try {
                let posts = await fetch(`${rootUrl}/wp-json/wp/v2/posts?search=${searchQuery}`);
                let postsData = await posts.json();
                setResults(postsData);
                setSpinnerActive(false);

                if (!postsData.length) {
                    setNoResultsActive(true);
                }
            } catch (err) {
                console.error(err);
            }
        }
    }, 300);

    useEffect(() => {
        const handleKeyDown = (e) => {
            if (searchActive && e.key === 'Escape') {
                setSearchToInactive();
            }
        };

        document.addEventListener('keydown', handleKeyDown);

        return () => {
            document.removeEventListener('keydown', handleKeyDown);
        };
    }, [searchActive]);

    useEffect(() => {
        if (searchQuery) {
            search();
        }
    }, [searchQuery]);

    return (
        <div>
            {searchActive && (
                <div className="fixed overflow-auto w-full h-full bg-white z-50 left-0 top-0">
                    <div className="container max-w-7xl mx-auto flex flex-col md:mb-12 px-3 xl:px-0 py-16">
                        <div className="flex w-full justify-end items-center">
                            <p className="mr-2 text-gray-300 italic font-serif">(Esc to exit)</p>
                            <span onClick={setSearchToInactive}>
                                <i className="text-xl cursor-pointer fas fa-close"></i>
                            </span>
                        </div>
                        <input
                            ref={searchInput}
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                            autoComplete="off"
                            className="border-b border-2 border-x-0 border-t-0 bg-transparent h-12 outline-none border-gray-300 text-gray-600 w-full text-xl"
                            type="text"
                            placeholder="Search..."
                        />
                        {/* Results */}
                        <div className="mt-4">
                            {searchQuery.length && spinnerActive && (
                                <div role="spinner">
                                    <svg
                                        aria-hidden="true"
                                        className="mr-2 w-8 h-8 text-gray-200 animate-spin fill-[#a69778]"
                                        viewBox="0 0 100 101"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                            fill="currentColor"
                                        />
                                        <path
                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                            fill="currentFill"
                                        />
                                    </svg>
                                    <span className="sr-only">Loading...</span>
                                </div>
                            )}
                            {noResultsActive && <p className="text-[#a69778] font-serif">No results :(</p>}
                            {/* results */}
                            <div className="flex flex-wrap">
                                {results.map((result, index) => (
                                    <div key={index} className="group relative mb-3 w-full md:w-1/3 px-2">
                                        <a href={result.link}>
                                            <div className="relative w-full h-72 bg-white overflow-hidden group-hover:opacity-75 ease duration-100">
                                                <img
                                                    src={result.thumbnail}
                                                    alt={result.title.rendered}
                                                    title={result.title.rendered}
                                                    className="w-full h-full object-center object-cover"
                                                />
                                            </div>
                                            <div className="pt-5">
                                                {result.type === 'recipe' && (
                                                    <div className="mb-3 flex">
                                                        <p className="text-sm uppercase font-bold mr-4 flex">
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                className="h-4 w-4"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor"
                                                            >
                                                                <path
                                                                    strokeLinecap="round"
                                                                    strokeLinejoin="round"
                                                                    strokeWidth="2"
                                                                    d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"
                                                                />
                                                                <path
                                                                    strokeLinecap="round"
                                                                    strokeLinejoin="round"
                                                                    strokeWidth="2"
                                                                    d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"
                                                                />
                                                            </svg>
                                                            {result.acf.calories}kcal
                                                        </p>
                                                        <p className="text-gray-500 text-sm uppercase font-bold mr-4">
                                                            protein {result.acf.protein}g
                                                        </p>
                                                        <p className="text-gray-500 text-sm uppercase font-bold mr-4">
                                                            carbs {result.acf.carbs}g
                                                        </p>
                                                        <p className="text-gray-500 text-sm uppercase font-bold mr-4">
                                                            fat {result.acf.fat}g
                                                        </p>
                                                    </div>
                                                )}
                                                <h3 className="text-xl font-serif hover:text-gray-600 ease duration-100">
                                                    {result.title.rendered}
                                                </h3>
                                                <p
                                                    className="text-gray-500 mt-3 mb-6 font-serif"
                                                    dangerouslySetInnerHTML={{ __html: result.excerpt.rendered }}
                                                ></p>
                                            </div>
                                        </a>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            )}
            <span
                onClick={setSearchToActive}
                className="bg-transparent  cursor-pointer flex items-center"
            >
                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M22.35 9.66C22.35 14.6247 18.2461 18.67 13.158 18.67C8.06985 18.67 3.96592 14.6247 3.96592 9.66C3.96592 4.6953 8.06985 0.65 13.158 0.65C18.2461 0.65 22.35 4.6953 22.35 9.66Z"
                        stroke="black" strokeWidth="1.3" />
                    <line y1="-0.65" x2="9.19376" y2="-0.65" transform="matrix(0.713677 -0.700475 0.713677 0.700475 1 23)"
                        stroke="black" strokeWidth="1.3" />
                </svg>
            </span>
        </div>
    );
};

export default ReactSearch;