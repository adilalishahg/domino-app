// resources/js/Pages/Pizzas/Index.jsx

import React from "react";
import { Link } from "@inertiajs/inertia-react";

const PizzasIndex = ({ pizzas }) => {
    return (
        <div>
            <h1>Pizzas Index Page</h1>
            {/* Add your component logic and JSX here */}
            <ul>
                {pizzas.map((pizza) => (
                    <li key={pizza.id}>{pizza.name}</li>
                ))}
            </ul>
            <Link href={route("pizzas.create")}>Create Pizza</Link>
        </div>
    );
};

export default PizzasIndex;
